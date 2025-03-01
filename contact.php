<?php /* Template Name: Contact */ ?>
<?php get_header(); ?>
<main class="flex flex-col items-center justify-between w-full">

    <!--            Contact-Us             -->
    <section class="section">
        <div class="flex flex-col items-center justify-center gap-6 xl:flex-row box sm:gap-10 md:gap-6">
            <div class="flex flex-col items-center justify-start w-full gap-4 sm:items-start sm:gap-8">
                <h1 class="text-[28px] font-semibold text-[#838A9A]">ارتباط با ما</h1>
                <div
                        class="bg-[#FAFBFB] text-[14px] sm:text-[16px] p-6 sm:p-11 rounded-md flex flex-col justify-start items-start gap-6 w-full">
                    <div class="flex items-start justify-start gap-4 font-medium text-[#30353F]">
                        <img src="<?= assets('/images/icons/city-icon.svg') ?>" alt="آدرس"/>
                        <p>تهران، بزرگراه آفریقا، بالاتر از جهان کودک، نبش دیدار شمالی، پلاک 51. طبقه 7</p>
                    </div>
                    <div class="flex items-start justify-start gap-4 font-medium text-[#30353F]">
                        <img src="<?= assets('/images/icons/phone-light-icon.svg') ?>" alt="شماره تماس"/>
                        <p>021-8700</p>
                    </div>
                    <div class="flex items-start justify-start gap-4 font-medium text-[#30353F]">
                        <img src="<?= assets('/images/icons/email-light-icon.svg') ?>" alt="ایمیل"/>
                        <p>info@mofidentekhab.com</p>
                    </div>
                </div>
            </div>
            <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5139.537480910189!2d51.41305589296392!3d35.758041356723105!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3f8e016403a2b133%3A0x4c0055d5d36bc42c!2sMofid%20Securities!5e0!3m2!1sen!2sde!4v1709726935894!5m2!1sen!2sde"
                    style="border:0; " class="w-full xl:min-w-[655px] xl:min-h-[356px] min-h-[370px] rounded-md"
                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>


        </div>
    </section>
    <!--            Contact-Us             -->

</main>
<?php get_footer(); ?>
