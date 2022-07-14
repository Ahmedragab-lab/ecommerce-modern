<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <li class="nav-item">
        <a class="nav-link" href="{{ route('shopcart') }}">
            <i class="fas fa-dolly-flatbed me-1 text-gray"></i>
            <small class="text-gray fw-normal">
                ({{ Cart::instance('cart')->count() }})
                ({{ Cart::instance('cart')->content()->pluck('model')->count() }})
                {{-- ({{ $cartcount }}) --}}
            </small>
        </a>
    </li>
</div>
