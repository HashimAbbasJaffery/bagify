import { createApp } from 'vue';

const initCartVue = () => {
    const cartPage = document.getElementById('cart-page');
    if (!cartPage) return;

    createApp({
        data() {
            return {
                cart: {
                    items: [],
                    count: 0,
                    subtotal: 0,
                    subtotal_formatted: '0.00'
                },
                relatedProducts: [],
                loading: true,
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
            async fetchCart() {
                this.loading = true;
                try {
                    const res = await fetch('/api/cart');
                    const data = await res.json();
                    if (data.success) {
                        this.cart = data.cart;
                    }
                } catch (err) {
                    console.error("Error loading cart:", err);
                } finally {
                    this.loading = false;
                }
            },
            async updateQty(key, newQty) {
                if (newQty < 1) return;
                try {
                    const res = await fetch(`/api/cart/${key}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                        },
                        body: JSON.stringify({
                            quantity: newQty
                        })
                    });
                    const data = await res.json();
                    if (data.success) {
                        this.cart = data.cart;
                        // Synchronize the header badge and dynamic side drawer
                        if (window.refreshCartDrawer) window.refreshCartDrawer();
                    } else {
                        alert(data.message || "Failed to update quantity.");
                    }
                } catch (err) {
                    console.error("Error updating quantity:", err);
                }
            },
            async removeItem(key) {
                try {
                    const res = await fetch(`/api/cart/${key}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                        }
                    });
                    const data = await res.json();
                    if (data.success) {
                        this.cart = data.cart;
                        if (window.refreshCartDrawer) window.refreshCartDrawer();
                    }
                } catch (err) {
                    console.error("Error removing item:", err);
                }
            },
            formatPrice(price) {
                return new Intl.NumberFormat().format(price);
            },
            checkout() {
                window.location.href = '/checkout';
            },
            async fetchRelatedProducts() {
                this.loadingRelated = true;
                try {
                    const res = await fetch('/api/products/recommended');
                    const data = await res.json();
                    this.relatedProducts = data.data || data;
                } catch (err) {
                    console.error("Error loading related products:", err);
                } finally {
                    this.loadingRelated = false;
                }
            }
        },
        mounted() {
            this.fetchCart();
            this.fetchRelatedProducts();
        }
    }).mount('#cart-page');
};

document.addEventListener('DOMContentLoaded', initCartVue);
