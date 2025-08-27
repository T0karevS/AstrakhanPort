<template>
    <div class="contacts_mainblock">
        
        <div class="contact-section">
            <img src="/images/ffff.jpg" alt="">
            <div class="contact-item">
               <span class="contact-title">Режим работы:</span> Пн. – Пт.: с 9:00 до 18:00        
            </div>
            <div class="contact-item">
                <span class="contact-title">Факс:</span> 56-36-24
            </div>

            <div class="contact-item">
                <span class="contact-title">E-mail:</span> astrakhanport@mail.ru
            </div>

            <div class="contact-item">
                <span class="contact-title">Отдел грузовой и коммерческий работы (экспорт):</span><br>
                <span class="contact-title">Тел:</span> +7(927) 280-31-20, (8512) 44-28-88 (доб. 2)<br>
                <span class="contact-title">E-mail:</span> commercial.astrakhanport@mail.ru (информация для
                коммерческого отдела)
            </div>

            <div class="contact-item">
                <span class="contact-title">Отдел грузовой и коммерческий работы (импорт):</span><br>
                <span class="contact-title">Тел:</span> +7(927) 562-71-03, (8512) 44-28-88 (доб. 7)<br>
                <span class="contact-title">E-mail:</span> to-astrport@mail.ru
            </div>

            <div class="contact-item">
                <span class="contact-title">Отдел снабжения:</span> (8512) 44-28-88 (доб. 3)<br>
                <span class="contact-title">E-mail:</span> port414006@mail.ru
            </div>

            <div class="contact-item">
                <span class="contact-title">Отдел кадров:</span> (8512) 44-28-88 (доб. 5)<br>
                <span class="contact-title">E-mail:</span> astrakhanport@mail.ru
            </div>

            <div class="contact-item">
                <span class="contact-title">Юридический отдел:</span> (8512) 44-28-88 (доб. 6)<br>
                <span class="contact-title">E-mail:</span> astrakhanport@mail.ru
            </div>

            <div class="contact-item">
                <span class="contact-title">Бухгалтерия:</span> +7(908) 612-13-37, (8512) 44-28-88 (доб. 4)<br>
                <span class="contact-title">E-mail:</span> astraport@bk.ru (информация для бухгалтерии)
            </div>
            <button @click="openModal()" class="Ybtn">Свяжитесь с нами</button>
        </div>
        <div class="map-mini" style="position:relative;overflow:hidden;">
            <iframe
                src="https://yandex.ru/map-widget/v1/?ll=48.021045%2C46.382814&mode=poi&origin=jsapi&poi%5Bpoint%5D=48.020752%2C46.383135&poi%5Buri%5D=ymapsbm1%3A%2F%2Forg%3Foid%3D1722460103&z=19.31"
                 frameborder="1" allowfullscreen="true" style="position:relative;">
            </iframe>
        </div>
    </div>

</template>
<script setup>
import '../../css/contacts.css'
import '../../css/style.css'
import { openModal } from '@/modal.js';
</script>