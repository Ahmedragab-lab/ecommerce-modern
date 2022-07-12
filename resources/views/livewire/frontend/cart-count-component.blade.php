<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-dolly-flatbed me-1 text-gray"></i>
            Cart
            <small class="text-gray fw-normal">
                ({{ Cart::instance('cart')->count() }})
            </small>
        </a>
    </li>
</div>
