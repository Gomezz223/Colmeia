/*
 * Script Principal - Projeto Colmeia
 * Funcionalidades: Animações Visuais (Menu Mobile, Scroll, Microinterações)
 * Nota: Lógica de formulários e validações é processada exclusivamente pelo PHP.
 */

document.addEventListener('DOMContentLoaded', () => {
    initMobileMenu();
    initScrollAnimations();
    initMicroInteractions();
});

/* --- MENU MOBILE --- */
function initMobileMenu() {
    const menuToggle = document.getElementById('menu-toggle');
    const menuIcon = document.querySelector('.menu-icon');
    const menu = document.querySelector('.menu');
    const header = document.querySelector('header');
    const menuLinks = document.querySelectorAll('.menu a');

    if (!menuIcon || !menu) return;

    function toggleMenu() {
        const isActive = menu.classList.contains('active');
        if (isActive) closeMenu();
        else openMenu();
    }

    function openMenu() {
        menu.classList.add('active');
        menuIcon.classList.add('active');
        menuIcon.setAttribute('aria-expanded', 'true');
        if(menuToggle) menuToggle.checked = true;
    }

    function closeMenu() {
        menu.classList.remove('active');
        menuIcon.classList.remove('active');
        menuIcon.setAttribute('aria-expanded', 'false');
        if(menuToggle) menuToggle.checked = false;
    }

    menuIcon.addEventListener('click', (e) => {
        e.preventDefault();
        toggleMenu();
    });

    menuLinks.forEach(link => {
        link.addEventListener('click', closeMenu);
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && menu.classList.contains('active')) closeMenu();
    });

    // Fechar ao clicar fora
    document.addEventListener('click', (e) => {
        if (!header.contains(e.target) && menu.classList.contains('active')) {
            closeMenu();
        }
    });
}

/* --- SCROLL ANIMATIONS --- */
function initScrollAnimations() {
    // Seleciona elementos principais para animar a entrada
    const elementsToAnimate = document.querySelectorAll(
        '.animate-on-scroll, section, article, .bannerbody, .footer-info, .footer-qr, .footer-text, .product-card'
    );

    const observerOptions = {
        threshold: 0.1, // Dispara quando 10% do elemento estiver visível
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target); // Anima apenas uma vez
            }
        });
    }, observerOptions);

    elementsToAnimate.forEach(el => {
        el.classList.add('hidden-state');
        observer.observe(el);
    });
}

/* --- MICROINTERAÇÕES (VISUAL APENAS) --- */
function initMicroInteractions() {
    // Adiciona efeito visual de "Ripple" (onda) ao clicar em botões
    const buttons = document.querySelectorAll('.btn-cta, .saibamais, button, .btn-product');

    buttons.forEach(btn => {
        btn.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            ripple.classList.add('ripple');
            this.appendChild(ripple);
            
            const rect = this.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            ripple.style.left = `${x}px`;
            ripple.style.top = `${y}px`;
            
            setTimeout(() => ripple.remove(), 600);
        });
    });
}
