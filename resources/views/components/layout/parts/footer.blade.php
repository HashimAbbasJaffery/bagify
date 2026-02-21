<footer class="bg-primary font-poppins h-[423px]">
    <div class="container flex h-full top-footer">
        <div class="our-stores flex flex-col justify-center">
            <div>
                <h1 class="text-white text-[26px] font-semibold mb-5 leading-none">Our Stores</h1>
                <div class="flex gap-[36px]">
                    <ul class="text-lightgrey text-[16px] flex flex-col gap-[20px] store-list">
                        <li>
                            <a href="#">New York</a>
                        </li>
                        <li>
                            <a href="#">London SF</a>
                        </li>
                        <li>
                            <a href="#">Edinburgh</a>
                        </li>
                        <li>
                            <a href="#">Los Angeles</a>
                        </li>
                        <li>
                            <a href="#">Chicago</a>
                        </li>
                        <li>
                            <a href="#">Las Vegas</a>
                        </li>
                    </ul>
                    <ul class="text-lightgrey text-[16px] flex flex-col gap-[20px] store-list">
                        <li>
                            <a href="#">New York</a>
                        </li>
                        <li>
                            <a href="#">London SF</a>
                        </li>
                        <li>
                            <a href="#">Edinburgh</a>
                        </li>
                        <li>
                            <a href="#">Los Angeles</a>
                        </li>
                        <li>
                            <a href="#">Chicago</a>
                        </li>
                        <li>
                            <a href="#">Las Vegas</a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <div class="who-are-we bg-shade text-center flex justify-center items-center">
            <div>
                <img class="m-auto" src="{{ asset('assets/images/white-logo.png') }}" />
                <p class="text-[14px] text-lightgrey w-[300px] leading-[30px] m-auto mt-[20px]">Use this text area
                    to inform your customers
                    about your brand and vision. You can
                    modify it in the theme editor.</p>
                <h2 class="text-[26px] text-white font-semibold mt-[30px]">Social media</h2>
                <ul class="flex justify-center gap-[20px] mt-[20px]">
                    <li>
                        <a class="footer-social-media-icons" href="#">
                            <i class="fa-brands fa-google"></i>
                        </a>
                    </li>
                    <li>
                        <a class="footer-social-media-icons" href="#">
                            <i class="fa-brands fa-x-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a class="footer-social-media-icons" href="#">
                            <i class="fa-brands fa-linkedin-in"></i>
                        </a>
                    </li>
                    <li>
                        <a class="footer-social-media-icons" href="#">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="newsletter flex items-center">
            <div>
                <h3 class="text-[26px] text-white font-semibold">Subscribe Newsletter</h3>
                <p class="text-[18px] text-lightgrey mt-[20px]">Stay up to date on events, collections
                    and exclusive news</p>
                <input type="email"
                    class="focus:outline-none w-[380px] mt-[26px] rounded-small bg-shade text-lightgrey text-center text-[14px] py-[10px]"
                    placeholder="Enter Your Email Address" />
                <button
                    class="cursor-pointer bg-white w-[380px] flex justify-center items-center rounded-small mt-[20px]">
                    <img class="mr-[10px] py-[10px]" src="{{ asset('assets/images/subscribe.png') }}" />
                    Subscribe
                </button>
                <div>
                </div>
            </div>
        </div>
    </div>
    <hr class="border-primary">
    <div class="bottom-footer bg-shade h-[60px] flex items-center">
        <div class="container flex justify-between text-white">
            <p class="text-[14px]">Copyright 2026 Website created by <span class="font-semibold">Hashim Abbas</span> All Rights Reserved</p>
            <ul class="flex items-center gap-[15px] text-[15px]">
                <li>
                    <a href="#">Refund Policy</a>
                </li>
                <li><img src="{{ asset("assets/images/circle.png") }}" /></li>
                <li>
                    <a href="#">Privacy Policy</a>
                </li>
                <li><img src="{{ asset("assets/images/circle.png") }}" /></li>
                <li>
                    <a href="#">Terms of service</a>
                </li>
            </ul>
        </div>
    </div>
</footer>