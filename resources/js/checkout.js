import { createApp } from 'vue';

const initCheckoutVue = () => {
    const checkoutPage = document.getElementById('checkout-page');
    if (!checkoutPage) return;

    createApp({
        data() {
            return {
                cart: {
                    items: [],
                    count: 0,
                    subtotal: 0,
                    subtotal_formatted: '0.00'
                },
                form: {
                    first_name: '',
                    last_name: '',
                    country: 'Pakistan',
                    street_address: '',
                    postcode: '',
                    city: '',
                    phone: '',
                    email: '',
                    notes: ''
                },
                errors: {},
                loadingCart: true,
                loadingOrder: false,
                relatedProducts: [],
                loadingRelated: true
            }
        },
        computed: {
            deliveryCost() {
                return 'Free';
            },
            totalCost() {
                return this.cart.subtotal;
            },
            totalCostFormatted() {
                return new Intl.NumberFormat().format(this.totalCost);
            }
        },
        methods: {
            fetchCart() {
                this.loadingCart = true;
                return fetch('/api/cart')
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            this.cart = data.cart;
                            if (this.cart.items.length === 0) {
                                window.location.href = '/shop';
                            }
                        }
                    })
                    .catch(err => {
                        console.error("Error loading checkout cart:", err);
                    })
                    .finally(() => {
                        this.loadingCart = false;
                    });
            },
            fetchRelated() {
                this.loadingRelated = true;
                return fetch('/api/products/recommended')
                    .then(res => res.json())
                    .then(data => {
                        this.relatedProducts = data.data || data;
                    })
                    .catch(err => {
                        console.error("Error loading checkout related products:", err);
                    })
                    .finally(() => {
                        this.loadingRelated = false;
                    });
            },
            async placeOrder() {
                this.errors = {};
                this.loadingOrder = true;
                try {
                    const res = await fetch('/checkout', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                        },
                        body: JSON.stringify(this.form)
                    });
                    
                    const data = await res.json();
                    
                    if (res.status === 422) {
                        this.errors = data.errors || {};
                        // Scroll to the first error
                        const firstError = Object.keys(this.errors)[0];
                        if (firstError) {
                            const el = document.getElementsByName(firstError)[0] || document.getElementById(firstError);
                            if (el) el.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        }
                    } else if (data.success && data.redirect) {
                        // Redirect to the success screen
                        window.location.href = data.redirect;
                    } else {
                        alert(data.message || "Failed to process checkout order.");
                    }
                } catch (err) {
                    console.error("Checkout order placement error:", err);
                    alert("An error occurred during payment processing. Please try again.");
                } finally {
                    this.loadingOrder = false;
                }
            },
            formatPrice(price) {
                return new Intl.NumberFormat().format(price);
            }
        },
        mounted() {
            Promise.all([this.fetchCart(), this.fetchRelated()]).then(() => {
                const skeleton = document.getElementById('checkout-skeleton');
                const app = document.getElementById('checkout-page');
                if (skeleton && app) {
                    skeleton.style.display = 'none';
                    app.style.opacity = '1';
                }
            });
        }
    }).mount('#checkout-page');
};

document.addEventListener('DOMContentLoaded', initCheckoutVue);
