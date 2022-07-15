<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <li class="nav-item">
        <a class="nav-link" href="{{ route('wishlist') }}">
            <i class="far fa-heart me-1"></i>
            <small class="text-gray fw-normal">
                ({{ Cart::instance('wishlist')->count() }})
            </small>
        </a>
    </li>
</div>
