<template>
    <div class="service_mainscreen">
        <img :src="pageData.image" alt="" class="service_mainscreen">
    </div>
    <div class="idk_maybeitwork">

        <div class="services_contact">

            <div class="services_contact_inner">
                <img src="/images/document.svg" class="services_contact_img">
                <div class="">
                    <p class="">Оформите заявку на услугу, мы свяжемся с вами в ближайшее время и ответим на все
                        интересующие вопросы.</p>
                </div>
                <button class="Ybtn">Заказать услугу</button>
                <button class="Xbtn">?</button>
            </div>
        </div>
    </div>
    <div class="services_textblock" v-html="pageData.text">
    </div>
    <div class="gallery">
        <Gallery :images="pageData.galleryImages" />
    </div>
    <div class="teasers_mini">
        <div class="teasers_block">
            
            <div class="teasers_l1">24/7</div>
            <div class="teasers_l2">Готовы отвечать на вопросы в любое время</div>
        </div>
        <div class="teasers_block">
            <div class="teasers_l1">500+</div>
            <div class="teasers_l2">Мы надежные партнеры</div>
        </div>
        <div class="teasers_block">
            <div class="teasers_l1">24/7</div>
            <div class="teasers_l2">Мы надежные партнеры</div>
        </div>
    </div>
</template>
<script setup>
import '../../css/services.css'
import Gallery from '@/components/Gallery.vue'
import { usePage, Head } from '@inertiajs/vue3'
const servicesData = {
    'import': {
        image: "/images/import.jpg",
        text: "<p>Отдел импорта ПАО «Астраханский порт» является ключевым подразделением, ответственным за организацию и контроль ввоза зарубежных товаров.</p> <p>Наличие на территории Порта СВХ (склад временного хранения) открытого типа позволяет своевременно проводить складские операции по перевалке импортных грузов. <p>В 2023 году площадь СВХ была увеличена до 14 700 м2 что способствует увеличению грузопотока импортных товаров.</p><p> На территории СВХ расположен «холодный коридор» для переработки скоропортящихся товаров. Возможность единовременного размещения и подключения до 40 единиц реф. контейнеров.</p><p> Специалисты отдела ведут учет импортируемых товаров, осуществляют контроль за соблюдением договорных обязательств с контрагентами и соблюдением всех законодательных требований.</p>"
    },
    'tamozhnya': {
        image: "/images/tamozhnya.jpg",
        text: "<p>Таможенное оформление грузов на всей территории РФ.</p><p>Лицензированный таможенный представитель ПАО «Астраханский порт».</p><p><b>Мы предлагаем:</b></p><ul><li>комплексное декларирование;</li><li>таможенная очистка грузов;</li><li>любые виды таможенных процедур;</li></ul><p><b>Нашу репутацию знают:</b></p><ul><li>в таможенных органах;</li><li>в государственных органах;</li><li>в профессиональных и отраслевых сообществах;</li></ul><p><b>Любые виды грузов:</b></p><ul><li>Генеральные</li><li>Контейнерные</li><li>Крупногабаритные</li><li>Сыпучие грузы</li><li>Опасные грузы</li><li>Тяжеловесные грузы</li></ul>",
        galleryImages: [
            "/images/kran.jpg",
            "/images/ffff.jpg",
        ]    
    },
    'export': {
        image: "/images/import.jpg",
        text: "<p>ПАО Астраханский порт предлагает Вам безопасное и надежное партнерство в области экспорта. Наш порт – важное звено в логистической цепи г.Астрахани, которое вот уже более 20 лет обеспечивает перевозку грузов между странами и континентами.</p> <p>Наши экспортные операции включают в себя все этапы – начиная от загрузки грузов на судно и заканчивая их доставкой в пункт назначения. От исходного пункта отправляются товары различной категории – от сельскохозяйственной продукции и нефти до производственного оборудования и машин.</p><p>Наша команда экспертов готова предоставить консультации и поддержку в любом вопросе, связанным с экспортом. Мы подстроимся под ваши потребности, поможем разрешить возникшие проблемы и предложим оптимальные решения.</p><p>Одним из основных достоинств Астраханского порта является высокая грузоподъемность судов, что делает его экономически выгодным для перевозки больших объемов грузов.</p><p>Организация экспорта для нас требует тщательного планирования и соблюдения всех требований и норм, установленных международными организациями и государственными органами по безопасности при перевозке грузов. Кроме того, необходимо учесть различные аспекты, такие как упаковка груза, его маркировка и документация, чтобы гарантировать безопасность и сохранность товаров во время пути следования.</p><p>С каждым клиентом работает целая команда профессионалов, которая выполняет следующие функции:</p><ul>  <li>Разработка и заключение договоров</li>  <li>Оказание услуг организациям на погрузо-разгрузочные работы</li>  <li>Контроль за правильным обслуживанием клиентов</li>  <li>Контроль над формированием пакета документов</li>  <li>Обработка входящих документов</li>  <li>Учёт груза клиентов</li></ul> <p>Работая с нами вы получите максимальную эффективность и надежность в каждом этапе доставки груза! Обратитесь к нам сегодня и убедитесь сами в качестве наших услуг.</p>"
    },
    'termoobrabotka': {
        image: "/images/termo.png",
        text: "<p>Сегодня наше предприятие готово предложить комплекс услуг в области термообработки пиломатериалов и изделий из них, полностью учитывая специфику процесса обеззараживания.</p><p>Термообработка - один из самых распространенных методов обработки пиломатериала.</p><p>Этот метод обеззараживания признается эффективным для уничтожения большинства видов вредителей древесины на любой фазе развития.</p>",
    },
    'teo': {
        image: "/images/kran.jpg",
        text: "<p>Экспедирование грузов - один из важнейших пунктов логистики, к которому необходимо подойти серьезно, планируя междугородние и международные перевозки.</p><p>Наша компания готова организовать полный комплекс транспортно-экспедиционных услуг. Мы оказываем услуги в строгом соответствии с Законом о «Транспортно-экспедиторской деятельности».</p><p><b>Наши преимущества:</b></p><ul><li>Сохранность и безопасность груза;</li><li>Оперативность. Владея полной картиной событий, имея необходимый опыт и компетенцию, специалист быстро принимает важные решения относительно грузов;</li><li>Экономия. Движение товаров по оптимальным маршрутам, корректно составленная документация позволяют пройти таможенную границу без задержек;</li><li>Правильное, точное оформление документов. Специалист может оформлять накладные, разрешения, грузовые документы.</li><li>Грамотное заполнение документов позволит исключить риск ошибок.</li></ul>",
    },
    'khranenie': {
        image: "/images/doski.png",
        text: "<p>Если вы ищете надежный и ответственный склад для хранения своих грузов, то вы попали по адресу!</p><p>ПАО «Астраханский порт» предлагает качественные услуги хранения груза в порту как на открытой площадке, так и в крытом складе, с учетом всех требований и потребностей наших клиентов. Ответственное хранение и складская обработка – гарантированы!</p><p>Мы принимаем на себя всю ответственность за сохранность и правильность обработки вашего груза.</p>",
    },
    'zh-d-gruzoperevozki': {
        image: "/images/poezd.jpg",
        text: "<p><b>Железнодорожная инфраструктура порта:</b></p><ul><li>Протяженность подъездных путей - 4 325,5 м</li><li>Количество путей - 6</li><li>Локомотивный парк: 3 единицы (1 × ТГМ-6А, 2 × ТГМ-40)</li><li>Весовое хозяйство: 2 веса (М8300А-150, Эталон-В-100)</li><li>Емкость путевого развития: >150 вагонов</li><li>Суточный грузооборот: до 90 вагонов</li><li>Дополнительное оборудование: 7 маслонасосов для ПГР</li><li>Система работы: интеграция с ОАО РЖД (ЭТРАН)</li><li>Собственный отдел железнодорожной логистики</li></ul>",
    },
    'morskie-gruzoperevozki': {
        image: '/images/marine.jpg',
        text: "<p><b>Международные морские перевозки</b> – один из наиболее значимых и популярных способов доставки грузов на большие расстояния по всему миру.</p><p>Этот вид транспорта используется для перевозки широкого спектра товаров – от продовольственных продуктов до машиностроительного оборудования. При выборе морской перевозки необходимо учитывать множество факторов, таких как:</p><ul><li>стоимость перевозки</li><li>время доставки</li><li>тип и характеристики груза</li><li>требования к таможенному оформлению</li><li>необходимость дополнительного страхования</li></ul>",
    }
}
const { url } = usePage()
const currentPath = url.split('/').pop() // получаем последнюю часть URL
const pageData = servicesData[currentPath]
</script>
