<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'group' => 'branding',
                'key' => 'name',
                'type' => 'text',
                'value' => 'Luxury',
            ],
            [
                'group' => 'branding',
                'key' => 'brand_logo',
                'type' => 'image',
                'value' => 'settings/brand.jpg', //manually upload
            ],
            [
                'group' => 'homepage',
                'key' => 'hero_main_text',
                'type' => 'json',
                'value' => '{"en": "Find Your Ideal Student Home — 3 to 12 Month Rentals", "ar": "ابحث عن سكن الطلاب المثالي لك - إيجارات من 3 إلى 12 شهرًا"}',
            ],
            [
                'group' => 'homepage',
                'key' => 'hero_sub_text',
                'type' => 'json',
                'value' => '{"en": "Discover comfortable, fully-furnished student accommodations near top universities and vibrant city centers. Flexible stays. Hassle-free living.", "ar": "اكتشف أماكن إقامة طلابية مريحة ومفروشة بالكامل..."}'
            ],
            [
                'group' => 'homepage',
                'key' => 'promo_header',
                'type' => 'json',
                'value' => '{"en": "Stages of booking a property", "ar": "مراحل حجز عقار"}',
            ],
            [
                'group' => 'homepage',
                'key' => 'online_reservation_title',
                'type' => 'json',
                'value' => '{"en": "Online reservation", "ar": "الحجز عبر الإنترنت"}',
            ],
            [
                'group' => 'homepage',
                'key' => 'online_reservation_text',
                'type' => 'json',
                'value' => '{"en": "Browse available student accommodations on our platform.", "ar": "تصفح أماكن إقامة الطلاب المتاحة على منصتنا."}',
            ],
            [
                'group' => 'homepage',
                'key' => 'documents_and_payment_title',
                'type' => 'json',
                'value' => '{"en": "Documents and payment", "ar": "المستندات والدفع"}',
            ],
            [
                'group' => 'homepage',
                'key' => 'documents_and_payment_text',
                'type' => 'json',
                'value' => '{"en": "Fill in your personal data and secure your booking by payment.", "ar": "املأ بياناتك الشخصية وأمن حجزك بالدفع."}',
            ],
            [
                'group' => 'homepage',
                'key' => 'contract_approval_title',
                'type' => 'json',
                'value' => '{"en": "Contract Approval", "ar": "الموافقة على العقد"}',
            ],
            [
                'group' => 'homepage',
                'key' => 'contract_approval_text',
                'type' => 'json',
                'value' => '{"en": "Once payment is successful, a rental agreement will be sent to your email.", "ar": "بمجرد نجاح الدفع، سيتم إرسال اتفاقية الإيجار إلى بريدك الإلكتروني."}',
            ],
            [
                'group' => 'homepage',
                'key' => 'handover_and_checkin_title',
                'type' => 'json',
                'value' => '{"en": "Handover & Check-In", "ar": "التسليم وتسجيل الوصول"}',
            ],
            [
                'group' => 'homepage',
                'key' => 'handover_and_checkin_text',
                'type' => 'json',
                'value' => '{"en": "Get ready to move in!", "ar": "استعد للانتقال!"}',
            ],
            [
                'group' => 'homepage',
                'key' => 'properties_title',
                'type' => 'json',
                'value' => '{"en": "Properties", "ar": "عقارات"}',
            ],
            [
                'group' => 'homepage',
                'key' => 'reviews_title',
                'type' => 'json',
                'value' => '{"en": "What our students say", "ar": "ماذا يقول طلابنا"}',
            ],
            [
                'group' => 'homepage',
                'key' => 'gallery_title',
                'type' => 'json',
                'value' => '{"en": "Photos of our properties", "ar": "صور من عقاراتنا"}',
            ],
            [
                'group' => 'homepage',
                'key' => 'contacts_header_title',
                'type' => 'json',
                'value' => '{"en": "Find properties near by institutes", "ar": "ابحث عن العقارات القريبة من المعاهد"}',
            ],
            [
                'group' => 'homepage',
                'key' => 'contacts_header_subtitle',
                'type' => 'json',
                'value' => '{"en": "Discover student accommodations conveniently located near top universities, colleges, and learning centers. Save time on commuting and focus more on your studies and student life.", "ar": "اكتشف أماكن إقامة الطلاب بالقرب من أفضل الجامعات والكليات ومراكز التعلم. وفر الوقت في التنقل وركز أكثر على دراستك وحياتك الطلابية."}',
            ],
            [
                'group' => 'aboutpage',
                'key' => 'about_title',
                'type' => 'json',
                'value' => '{"en": "About", "ar": "عنّا"}',
            ],
            [
                'group' => 'aboutpage',
                'key' => 'about_text',
                'type' => 'json',
                'value' => '{"en": "Discover our story and what makes us the perfect choice for your stay", "ar": "اكتشف قصتنا وما يجعلنا الخيار الأمثل لإقامتك"}',
            ],
            [
                'group' => 'about_page',
                'key' => 'our_story_title',
                'type' => 'json',
                'value' => '{"en": "Our Story", "ar": "قصتنا"}',
            ],
            [
                'group' => 'about_page',
                'key' => 'our_story_paragraph_1',
                'type' => 'json',
                'value' => '{"en": "Founded in 2010, Luxury has been providing exceptional accommodation experiences for travelers from around the world. What started as a small hostel has grown into a beloved destination for backpackers, students, and budget-conscious travelers.", "ar": "تأسست لوكسري في عام 2010، ومنذ ذلك الحين وهي تقدم تجارب إقامة استثنائية للمسافرين من جميع أنحاء العالم. ما بدأ كنزل صغير تحول إلى وجهة محبوبة للمسافرين، الطلاب، والرحالة ذوي الميزانية المحدودة."}',
            ],
            [
                'group' => 'about_page',
                'key' => 'our_story_paragraph_2',
                'type' => 'json',
                'value' => '{"en": "Our mission is to create a welcoming, safe, and comfortable environment where travelers can connect, share stories, and create lasting memories. We believe that great accommodation should be accessible to everyone, regardless of budget.", "ar": "مهمتنا هي توفير بيئة ترحيبية وآمنة ومريحة حيث يمكن للمسافرين التواصل، تبادل القصص، وخلق ذكريات تدوم. نحن نؤمن بأن الإقامة الرائعة يجب أن تكون في متناول الجميع، بغض النظر عن الميزانية."}',
            ],
            [
                'group' => 'about_page',
                'key' => 'happy_students_label',
                'type' => 'json',
                'value' => '{"en": "Happy Students", "ar": "طلاب سعداء"}',
            ],
            [
                'group' => 'about_page',
                'key' => 'properties_label',
                'type' => 'json',
                'value' => '{"en": "Properties", "ar": "عقارات"}',
            ],
            [
                'group' => 'about_page',
                'key' => 'years_experience_label',
                'type' => 'json',
                'value' => '{"en": "Years Experience", "ar": "سنوات خبرة"}',
            ],
            [
                'group' => 'about_page',
                'key' => 'why_choose_luxury_title',
                'type' => 'json',
                'value' => '{"en": "Why Choose Luxury?", "ar": "لماذا تختار لوكسري؟"}',
            ],
            [
                'group' => 'about_page',
                'key' => 'prime_location_title',
                'type' => 'json',
                'value' => '{"en": "Prime Location", "ar": "موقع مميز"}',
            ],
            [
                'group' => 'about_page',
                'key' => 'prime_location_text',
                'type' => 'json',
                'value' => '{"en": "Located in the heart of the city, we\'re just minutes away from major attractions, public transportation, and local hotspots.", "ar": "يقع في قلب المدينة، على بعد دقائق فقط من المعالم الرئيسية ووسائل النقل العام والأماكن المحلية الشهيرة."}',
            ],
            [
                'group' => 'about_page',
                'key' => 'free_wifi_title',
                'type' => 'json',
                'value' => '{"en": "Free WiFi", "ar": "واي فاي مجاني"}',
            ],
            [
                'group' => 'about_page',
                'key' => 'free_wifi_text',
                'type' => 'json',
                'value' => '{"en": "Stay connected with complimentary high-speed WiFi throughout the property, perfect for work or staying in touch with loved ones.", "ar": "ابق على اتصال مع خدمة الواي فاي عالية السرعة المجانية في جميع أنحاء العقار، وهي مثالية للعمل أو البقاء على اتصال مع أحبائك."}',
            ],
            [
                'group' => 'about_page',
                'key' => '24_7_security_title',
                'type' => 'json',
                'value' => '{"en": "24/7 Security", "ar": "أمان على مدار الساعة"}',
            ],
            [
                'group' => 'about_page',
                'key' => '24_7_security_text',
                'type' => 'json',
                'value' => '{"en": "Your safety is our priority. We have 24/7 security and secure lockers to keep your belongings safe during your stay.", "ar": "سلامتك هي أولويتنا. لدينا أمان على مدار الساعة وخزائن آمنة للحفاظ على ممتلكاتك آمنة أثناء إقامتك."}',
            ],
            [
                'group' => 'about_page',
                'key' => 'social_atmosphere_title',
                'type' => 'json',
                'value' => '{"en": "Social Atmosphere", "ar": "أجواء اجتماعية"}',
            ],
            [
                'group' => 'about_page',
                'key' => 'social_atmosphere_text',
                'type' => 'json',
                'value' => '{"en": "Meet fellow travelers in our common areas, join organized activities, and make new friends from around the world.", "ar": "التقِ بالمسافرين الآخرين في مناطقنا المشتركة، وشارك في الأنشطة المنظمة، وتعرف على أصدقاء جدد من جميع أنحاء العالم."}',
            ],
            [
                'group' => 'about_page',
                'key' => 'clean_comfortable_title',
                'type' => 'json',
                'value' => '{"en": "Clean & Comfortable", "ar": "نظيف ومريح"}',
            ],
            [
                'group' => 'about_page',
                'key' => 'clean_comfortable_text',
                'type' => 'json',
                'value' => '{"en": "Our properties are cleaned daily and equipped with comfortable beds, fresh linens, and all the essentials you need.", "ar": "عقاراتنا يتم تنظيفها يوميًا ومجهزة بأسرة مريحة، وبياضات أسرّة نظيفة، وجميع الأساسيات التي تحتاجها."}',
            ],
            [
                'group' => 'about_page',
                'key' => 'friendly_staff_title',
                'type' => 'json',
                'value' => '{"en": "Friendly Staff", "ar": "موظفون ودودون"}',
            ],
            [
                'group' => 'about_page',
                'key' => 'friendly_staff_text',
                'type' => 'json',
                'value' => '{"en": "Our knowledgeable staff is always ready to help with recommendations, directions, and any questions you might have.", "ar": "موظفونا ذوو الخبرة دائمًا على استعداد للمساعدة في تقديم التوصيات، والإرشادات، والإجابة على أي أسئلة قد تكون لديك."}',
            ],
            [
                'group' => 'house_rules',
                'key' => 'main_header',
                'type' => 'json',
                'value' => '{"en": "House Rules", "ar": "قوانين المنزل"}',
            ],
            [
                'group' => 'house_rules',
                'key' => 'intro_text',
                'type' => 'json',
                'value' => '{"en": "To ensure everyone has a pleasant stay, please follow these guidelines :", "ar": "لضمان إقامة ممتعة للجميع، يرجى اتباع هذه الإرشادات:"}',
            ],
            [
                'group' => 'house_rules',
                'key' => 'check_in_header',
                'type' => 'json',
                'value' => '{"en": "Check-in/Check-out", "ar": "تسجيل الدخول/الخروج"}',
            ],
            [
                'group' => 'house_rules',
                'key' => 'check_in_time',
                'type' => 'json',
                'value' => '{"en": "Check-in: 2:00 PM - 10:00 PM", "ar": "تسجيل الدخول: 2:00 مساءً - 10:00 مساءً"}',
            ],
            [
                'group' => 'house_rules',
                'key' => 'check_out_time',
                'type' => 'json',
                'value' => '{"en": "Check-out: 11:00 AM", "ar": "تسجيل الخروج: 11:00 صباحًا"}',
            ],
            [
                'group' => 'house_rules',
                'key' => 'late_check_in_notice',
                'type' => 'json',
                'value' => '{"en": "Late check-in available with prior notice", "ar": "تسجيل دخول متأخر متاح بإشعار مسبق"}',
            ],
            [
                'group' => 'house_rules',
                'key' => 'quiet_hours_header',
                'type' => 'json',
                'value' => '{"en": "Quiet Hours", "ar": "ساعات الهدوء"}',
            ],
            [
                'group' => 'house_rules',
                'key' => 'quiet_hours_time',
                'type' => 'json',
                'value' => '{"en": "Quiet hours: 11:00 PM - 7:00 AM", "ar": "ساعات الهدوء: 11:00 مساءً - 7:00 صباحًا"}',
            ],
            [
                'group' => 'house_rules',
                'key' => 'respect_guests_note',
                'type' => 'json',
                'value' => '{"en": "Please respect other guests", "ar": "يرجى احترام الضيوف الآخرين"}',
            ],
            [
                'group' => 'house_rules',
                'key' => 'no_loud_music_note',
                'type' => 'json',
                'value' => '{"en": "No loud music or parties", "ar": "ممنوع الموسيقى الصاخبة أو الحفلات"}',
            ],
            [
                'group' => 'house_rules',
                'key' => 'smoking_policy_header',
                'type' => 'json',
                'value' => '{"en": "Smoking Policy", "ar": "سياسة التدخين"}',
            ],
            [
                'group' => 'house_rules',
                'key' => 'no_smoking_note',
                'type' => 'json',
                'value' => '{"en": "No smoking inside the building", "ar": "ممنوع التدخين داخل المبنى"}',
            ],
            [
                'group' => 'house_rules',
                'key' => 'designated_smoking_areas',
                'type' => 'json',
                'value' => '{"en": "Designated smoking areas available", "ar": "توجد مناطق مخصصة للتدخين"}',
            ],
            [
                'group' => 'house_rules',
                'key' => 'smoking_fee',
                'type' => 'json',
                'value' => '{"en": "Smoking fee applies if violated", "ar": "تطبق رسوم التدخين في حال المخالفة"}',
            ],
            [
                'group' => 'house_rules',
                'key' => 'pet_policy_header',
                'type' => 'json',
                'value' => '{"en": "Pet Policy", "ar": "سياسة الحيوانات الأليفة"}',
            ],
            [
                'group' => 'house_rules',
                'key' => 'additional_pet_fee',
                'type' => 'json',
                'value' => '{"en": "Additional cleaning fee applies", "ar": "تطبق رسوم تنظيف إضافية"}',
            ],
            [
                'group' => 'house_rules',
                'key' => 'inform_in_advance',
                'type' => 'json',
                'value' => '{"en": "Please inform us in advance", "ar": "يرجى إبلاغنا مسبقًا"}',
            ],
            [
                'group' => 'contacts',
                'key' => 'header_title',
                'type' => 'json',
                'value' => '{"en": "We are ready answer your question", "ar": "نحن مستعدون للإجابة على سؤالك"}',
            ],
            [
                'group' => 'contacts',
                'key' => 'header_text',
                'type' => 'json',
                'value' => '{"en": "Egestas pretium aenean pharetra magna ac. Et tortor consequat id porta nibh venenatis cras sed", "ar": "إيجيستاس بريتيوم أينيان فارينا ماجنا أك. إت تورتور كونسيكوات إد بورتا نيبه فينينا كراس سيد"}',
            ],
            [
                'group' => 'contacts',
                'key' => 'name_placeholder',
                'type' => 'json',
                'value' => '{"en": "Name", "ar": "الاسم"}',
            ],
            [
                'group' => 'contacts',
                'key' => 'email_placeholder',
                'type' => 'json',
                'value' => '{"en": "Email", "ar": "البريد الإلكتروني"}',
            ],
            [
                'group' => 'contacts',
                'key' => 'message_placeholder',
                'type' => 'json',
                'value' => '{"en": "Message", "ar": "الرسالة"}',
            ],
            [
                'group' => 'contacts',
                'key' => 'send_message_button',
                'type' => 'json',
                'value' => '{"en": "Send message", "ar": "إرسال رسالة"}',
            ],
            [
                'group' => 'faq',
                'key' => 'header_title',
                'type' => 'json',
                'value' => '{"en": "Frequently Asked Questions", "ar": "أسئلة مكررة"}',
            ],
            [
                'group' => 'faq',
                'key' => 'header_text',
                'type' => 'json',
                'value' => '{"en": "Find answers to common questions about your stay", "ar": "ابحث عن إجابات للأسئلة الشائعة حول إقامتك"}',
            ],
            [
                'group' => 'faq',
                'key' => 'question_1',
                'type' => 'json',
                'value' => '{"en": "What time is check-in and check-out?", "ar": "ما هو وقت تسجيل الدخول والمغادرة؟"}',
            ],
            [
                'group' => 'faq',
                'key' => 'answer_1',
                'type' => 'json',
                'value' => '{"en": "Check-in is from 2:00 PM to 10:00 PM, and check-out is at 11:00 AM. If you need to arrive earlier or later, please contact us in advance and we\'ll do our best to accommodate you.", "ar": "تسجيل الدخول من الساعة 2:00 مساءً حتى 10:00 مساءً، وتسجيل الخروج في الساعة 11:00 صباحًا. إذا كنت بحاجة إلى الوصول مبكرًا أو متأخرًا، يرجى الاتصال بنا مسبقًا وسنبذل قصارى جهدنا لاستيعابك."}',
            ],
            [
                'group' => 'faq',
                'key' => 'question_2',
                'type' => 'json',
                'value' => '{"en": "Do you provide towels and linens?", "ar": "هل تقدمون المناشف وبياضات الأسرّة؟"}',
            ],
            [
                'group' => 'faq',
                'key' => 'answer_2',
                'type' => 'json',
                'value' => '{"en": "Yes, we provide fresh towels and linens for all guests. Towels are changed daily, and linens are changed every 3 days for longer stays.", "ar": "نعم، نحن نقدم مناشف وبياضات أسرّة نظيفة لجميع الضيوف. يتم تغيير المناشف يوميًا، وتغيير البياضات كل 3 أيام للإقامات الطويلة."}',
            ],
            [
                'group' => 'faq',
                'key' => 'question_3',
                'type' => 'json',
                'value' => '{"en": "Is breakfast included?", "ar": "هل الإفطار مشمول؟"}',
            ],
            [
                'group' => 'faq',
                'key' => 'answer_3',
                'type' => 'json',
                'value' => '{"en": "We offer a complimentary continental breakfast from 7:00 AM to 10:00 AM daily. This includes coffee, tea, bread, jam, and seasonal fruits.", "ar": "نقدم إفطارًا قاريًا مجانيًا من الساعة 7:00 صباحًا حتى 10:00 صباحًا يوميًا. يشمل ذلك القهوة، والشاي، والخبز، والمربى، والفواكه الموسمية."}',
            ],
            [
                'group' => 'faq',
                'key' => 'question_4',
                'type' => 'json',
                'value' => '{"en": "Can I cancel my booking?", "ar": "هل يمكنني إلغاء حجزي؟"}',
            ],
            [
                'group' => 'faq',
                'key' => 'answer_4',
                'type' => 'json',
                'value' => '{"en": "Yes, you can cancel your booking up to 24 hours before check-in for a full refund. Cancellations within 24 hours may be subject to a cancellation fee.", "ar": "نعم، يمكنك إلغاء حجزك حتى 24 ساعة قبل تسجيل الدخول لاسترداد المبلغ بالكامل. قد تخضع الإلغاءات في غضون 24 ساعة لرسوم إلغاء."}',
            ],
            [
                'group' => 'faq',
                'key' => 'question_5',
                'type' => 'json',
                'value' => '{"en": "Do you have parking available?", "ar": "هل يوجد موقف سيارات متاح؟"}',
            ],
            [
                'group' => 'faq',
                'key' => 'answer_5',
                'type' => 'json',
                'value' => '{"en": "We have limited parking spaces available on a first-come, first-served basis. There\'s also public parking nearby. Please contact us in advance if you need parking.", "ar": "لدينا عدد محدود من أماكن وقوف السيارات المتاحة على أساس الأولوية. يوجد أيضًا موقف سيارات عام قريب. يرجى الاتصال بنا مسبقًا إذا كنت بحاجة إلى موقف للسيارات."}',
            ],
            [
                'group' => 'faq',
                'key' => 'card_title',
                'type' => 'json',
                'value' => '{"en": "Do you have any questions?", "ar": "هل لديك أي أسئلة؟"}',
            ],
            [
                'group' => 'faq',
                'key' => 'card_text',
                'type' => 'json',
                'value' => '{"en": "Diam phasellus vestibulum lorem sed risus ultricies tristique", "ar": "ديام فاسيلوس فستيبولوم لورم سيد ريزوس ألتريشيز تريستيك"}',
            ],
            [
                'group' => 'faq',
                'key' => 'card_button_text',
                'type' => 'json',
                'value' => '{"en": "Ask a question", "ar": "اطرح سؤالاً"}',
            ],

            [
                'group' => 'homepage',
                'key' => 'map',
                'type' => 'text',
                'value' => '-35.23729851439285, 139.5592634004934',
            ],
            [
                'group' => 'nearby',
                'key' => 'nearby_text',
                'type' => 'text',
                'value' => 'Discover student accommodations conveniently located near top universities, colleges, and learning centers. Save time on commuting and focus more on your studies and student life.',
            ],
            [
                'group' => 'contact',
                'key' => 'phone_primary',
                'type' => 'text',
                'value' => '+62 812-3456-7890',
            ],
            [
                'group' => 'contact',
                'key' => 'phone_secondary',
                'type' => 'text',
                'value' => '+62 812-3456-7890',
            ],
            [
                'group' => 'contact',
                'key' => 'email',
                'type' => 'text',
                'value' => 'support@studenthousing.com',
            ],
            [
                'group' => 'contact',
                'key' => 'address_line1',
                'type' => 'text',
                'value' => 'St Test 54739',
            ],
            [
                'group' => 'contact',
                'key' => 'address_line2',
                'type' => 'text',
                'value' => 'Kuala Lumpur, Malaysia',
            ],
            [
                'group' => 'contact',
                'key' => 'hours_days',
                'type' => 'text',
                'value' => 'Everyday',
            ],
            [
                'group' => 'contact',
                'key' => 'hours_time',
                'type' => 'text',
                'value' => '10 am — 20 pm',
            ],
            [
                'group' => 'socialmedia',
                'key' => 'facebook',
                'type' => 'text',
                'value' => 'facebook.com',
            ],
            [
                'group' => 'socialmedia',
                'key' => 'instagram',
                'type' => 'text',
                'value' => 'instagram.com',
            ],
            [
                'group' => 'socialmedia',
                'key' => 'twitter',
                'type' => 'text',
                'value' => 'twitter.com',
            ],
            [
                'group' => 'socialmedia',
                'key' => 'twitter',
                'type' => 'text',
                'value' => 'twitter.com',
            ],
            [
                'group' => 'socialmedia',
                'key' => 'whatsapp',
                'type' => 'text',
                'value' => '+608389222',
            ],
            [
                'group' => 'socialmedia',
                'key' => 'description',
                'type' => 'text',
                'value' => 'Lorem ipsum dolor sit ament amnesinia daritullarua',
            ],
            [
                'group' => 'payment',
                'key' => 'currency',
                'type' => 'text',
                'value' => 'RM',
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate([
                'key' => $setting['key'],
            ], $setting);
        }
    }
}
