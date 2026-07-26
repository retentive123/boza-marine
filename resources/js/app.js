import './bootstrap';

import Alpine from 'alpinejs';
import Swal from 'sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

window.Alpine = Alpine;
window.Swal = Swal;

Alpine.data('heroCarousel', (slides, autoplayMs = 6500) => ({
    current: 0,
    slides,
    timer: null,
    init() {
        if (this.slides.length > 1) this.play();
    },
    get active() {
        return this.slides[this.current] ?? {};
    },
    play() {
        this.stop();
        if (this.slides.length > 1) {
            this.timer = setInterval(() => this.next(), autoplayMs);
        }
    },
    stop() {
        if (this.timer) clearInterval(this.timer);
    },
    next() {
        this.current = (this.current + 1) % this.slides.length;
    },
    prev() {
        this.current = (this.current - 1 + this.slides.length) % this.slides.length;
    },
    goTo(i) {
        this.current = i;
        this.play();
    },
}));

Alpine.data('counter', (target, suffix = '') => ({
    display: '0',
    counted: false,
    init() {
        const numericTarget = parseFloat(target);

        if (isNaN(numericTarget)) {
            this.display = target;
            return;
        }

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting && !this.counted) {
                    this.counted = true;
                    this.animate(numericTarget);
                }
            });
        }, { threshold: 0.4 });

        observer.observe(this.$el);
    },
    animate(target) {
        const duration = 1400;
        const start = performance.now();
        const isInt = Number.isInteger(target);

        const step = (now) => {
            const progress = Math.min((now - start) / duration, 1);
            const eased = 1 - Math.pow(1 - progress, 3);
            const value = target * eased;
            this.display = isInt ? Math.round(value).toString() : value.toFixed(1);

            if (progress < 1) {
                requestAnimationFrame(step);
            } else {
                this.display = isInt ? target.toString() : target.toFixed(1);
            }
        };

        requestAnimationFrame(step);
    },
}));

Alpine.data('headlineRotator', (words, intervalMs = 2600) => ({
    words,
    current: 0,
    timer: null,
    init() {
        if (this.words.length > 1) {
            this.timer = setInterval(() => {
                this.current = (this.current + 1) % this.words.length;
            }, intervalMs);
        }
    },
}));

Alpine.data('headlineTyper', (words, typingSpeed = 75, deletingSpeed = 40, pauseMs = 1800) => ({
    words,
    display: '',
    wordIndex: 0,
    charIndex: 0,
    deleting: false,
    timer: null,
    init() {
        this.tick();
    },
    tick() {
        const currentWord = this.words[this.wordIndex] ?? '';

        if (!this.deleting) {
            this.charIndex++;
            this.display = currentWord.slice(0, this.charIndex);

            if (this.charIndex >= currentWord.length) {
                this.deleting = this.words.length > 1;
                this.timer = setTimeout(() => this.tick(), pauseMs);
                return;
            }

            this.timer = setTimeout(() => this.tick(), typingSpeed);
        } else {
            this.charIndex--;
            this.display = currentWord.slice(0, this.charIndex);

            if (this.charIndex <= 0) {
                this.deleting = false;
                this.wordIndex = (this.wordIndex + 1) % this.words.length;
                this.timer = setTimeout(() => this.tick(), typingSpeed);
                return;
            }

            this.timer = setTimeout(() => this.tick(), deletingSpeed);
        }
    },
}));

Alpine.data('lightbox', () => ({
    open: false,
    activeIndex: 0,
    show(index) {
        this.activeIndex = index;
        this.open = true;
    },
    close() {
        this.open = false;
    },
    next(total) {
        this.activeIndex = (this.activeIndex + 1) % total;
    },
    prev(total) {
        this.activeIndex = (this.activeIndex - 1 + total) % total;
    },
}));

Alpine.start();

document.addEventListener('submit', (event) => {
    const form = event.target.closest('form[data-confirm]');
    if (!form) return;

    event.preventDefault();

    Swal.fire({
        title: form.dataset.confirmTitle || 'Are you sure?',
        text: form.dataset.confirm,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: form.dataset.confirmButton || 'Yes, delete it',
        cancelButtonText: 'Cancel',
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#94a3b8',
        reverseButtons: true,
        focusCancel: true,
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const revealTargets = document.querySelectorAll('.reveal');

    if (!revealTargets.length) return;

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('reveal-visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' });

    revealTargets.forEach((el) => observer.observe(el));
});
