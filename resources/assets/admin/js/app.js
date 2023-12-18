import 'jquery';
import './bootstrap.js';
import Alpine from 'alpinejs';
import 'simplebar';
import 'simplebar/dist/simplebar.css';
import { ajaxProcessing, confirmAlert } from './sweetalert'

window.Alpine = Alpine;

Alpine.start();

(function () {
    "use strict";

    function initMetisMenu() {
        // MetisMenu js
        document.addEventListener("DOMContentLoaded", function () {
            if (document.getElementById("side-menu"))
                new MetisMenu("#side-menu");
        });
    }

    function initLeftMenuCollapse() {
        const currentSIdebarSize = document.body.getAttribute("data-sidebar-size");
        const verticalButton = document.getElementsByClassName("vertical-menu-btn");
        for (let i = 0; i < verticalButton.length; i++) {
            (function (index) {
                verticalButton[index] && verticalButton[index].addEventListener("click",
                    function (event) {
                        event.preventDefault();
                        document.body.classList.toggle("sidebar-enable");
                        if (window.innerWidth >= 992) {
                            if (currentSIdebarSize == null) {
                                document.body.getAttribute("data-sidebar-size") == null || document.body.getAttribute("data-sidebar-size") === "lg"
                                    ? document.body.setAttribute("data-sidebar-size", "sm")
                                    : document.body.setAttribute("data-sidebar-size", "lg");
                            }
                            else if (currentSIdebarSize === "md") {
                                document.body.getAttribute("data-sidebar-size") === "md"
                                    ? document.body.setAttribute("data-sidebar-size", "sm")
                                    : document.body.setAttribute("data-sidebar-size", "md");
                            } else {
                                document.body.getAttribute("data-sidebar-size") === "sm"
                                    ? document.body.setAttribute("data-sidebar-size", "lg")
                                    : document.body.setAttribute("data-sidebar-size", "sm");
                            }
                        }
                        else {
                            initMenuItemScroll();
                        }
                    }
                );
            })
            (i);
        }
    }

    function initActiveMenu() {
        setTimeout(function () {
            const menuItems = document.querySelectorAll("#sidebar-menu a");
            menuItems && menuItems.forEach(function (item) {
                const pageUrl = window.location.href.split(/[?#]/)[0];

                if (item.href === pageUrl) {
                    item.classList.add("active");
                    const parent = item.parentElement;
                    if (parent && parent.id !== "side-menu") {
                        parent.classList.add("mm-active");
                        const parent2 = parent.parentElement; // ul .
                        if (parent2 && parent2.id !== "side-menu") {
                            parent2.classList.add("mm-show"); // ul tag
                            if (parent2.classList.contains("mm-collapsing")) {
                                console.log("has mm-collapsing");
                            }
                            const parent3 = parent2.parentElement; // li tag
                            if (parent3 && parent3.id !== "side-menu") {
                                parent3.classList.add("mm-active"); // li
                                const parent4 = parent3.parentElement; // ul
                                if (parent4 && parent4.id !== "side-menu") {
                                    parent4.classList.add("mm-show"); // ul
                                    const parent5 = parent4.parentElement;
                                    if (parent5 && parent5.id !== "side-menu") {
                                        parent5.classList.add("mm-active"); // li
                                    }
                                }
                            }
                        }
                    }
                }
            });
        }, 0);
    }

    function initMenuItemScroll() {
        setTimeout(function () {
            const sidebarMenu = document.getElementById("side-menu");
            if (sidebarMenu) {
                const activeMenu = sidebarMenu.querySelector(".mm-active .active");
                let offset = activeMenu ? activeMenu.offsetTop : 0;
                if (offset > 300) {
                    offset = offset - 100;
                    const verticalMenu = document.getElementsByClassName("vertical-menu")
                        ? document.getElementsByClassName("vertical-menu")[0]
                        : "";
                    if (verticalMenu && verticalMenu.querySelector(".simplebar-content-wrapper")) {
                        setTimeout(function () {
                            verticalMenu.querySelector(".simplebar-content-wrapper").scrollTop = offset;
                        }, 0);
                    }
                }
            }
        }, 0);
    }

    function initComponents() {
        // tooltip
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // popover
        const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
        const popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl);
        });

        // toast
        const toastElList = [].slice.call(document.querySelectorAll(".toast"));
        const toastList = toastElList.map(function (toastEl) {
            return new bootstrap.Toast(toastEl);
        });
    }

    function imagePreview(inputId, previewId) {
        let preview = document.getElementById(previewId);
        let input = document.getElementById(inputId);
        $(input).on("change", function (e) {
            e.preventDefault();
            preview.style.display = "block";
            const [file] = input.files;
            if (file) {
                preview.src = URL.createObjectURL(file);
            }
        });
    }

    imagePreview("photo_url", "preview");
    imagePreview("foto", "preview");

    function initSelect2(id, placeholder = null) {
        $(id).select2({
            placeholder: placeholder,
            width: "100%",
            theme: "bootstrap-5",
        });
    }

    initSelect2(".select2");
    initSelect2(".select2 #mahasiswa", "Pilih mahasiswa");

    // function initCKEditor(className) {
    //     ClassicEditor.create($(className).get(0), {
    //         toolbar: ['bold', 'italic', 'link', 'bulletedList', 'numberedList'],
    //     }).catch(error => {
    //         console.log(error);
    //     });
    // }
    // initCKEditor('.ckeditor');

    function init() {
        initMetisMenu();
        initLeftMenuCollapse();
        initActiveMenu();
        initComponents();
        initMenuItemScroll();
    }

    init();

    window.$ = window.jQuery = $;
    window.ResizeObserver = ResizeObserver;
    window.ajaxProcessing = ajaxProcessing;
    window.confirmAlert = confirmAlert;
})();

