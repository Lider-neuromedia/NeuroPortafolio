/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

document.addEventListener('DOMContentLoaded', function () {
    configureInputFileChange();
    configureToggleDetailLinks();
});

function configureInputFileChange() {
    if (!document.querySelector('.custom-file-input')) return;

    let fileInputs = document.querySelectorAll('.custom-file-input');

    fileInputs.forEach(function (fileInput) {
        fileInput.addEventListener('change', function (e) {
            let fileName = e.target.files[0].name;
            let nextSibling = e.target.nextElementSibling;
            nextSibling.innerText = fileName;
        });
    });
}

function configureToggleDetailLinks() {
    if (!document.querySelector('.toggle-link-detail-btn')) return;

    const btns = document.querySelectorAll('.toggle-link-detail-btn');

    btns.forEach(function (btn) {
        btn.addEventListener('click', function (e) {

            const detailId = e.target.dataset.detail;
            const linkDetailElement = document.getElementById(detailId);
            linkDetailElement.classList.toggle("detail-hidden");

        });
    });
}

if (document.getElementById('brief-form-app')) {
    require('./briefForm');
}

if (document.getElementById('project-form-app')) {
    require('./projectForm');
}

if (document.getElementById('monthly-app')) {
    require('./chartMonthly');
}

if (document.getElementById('events-app')) {
    require('./chartEvents');
}
