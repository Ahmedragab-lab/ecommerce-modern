@extends('frontend.layout.master')
@section('title', 'shop')
@section('content')
<livewire:frontend.product-modal-shared />
<livewire:frontend.shop />


@endsection
@section('js')
<script>
    let product_blocks = document.querySelectorAll('#products-container-area');
    document.getElementById('two_items').onclick = function () {
        Array.prototype.forEach.call(product_blocks, function (product_block) {
            if (product_block.classList.contains('col-3')||product_block.classList.contains('col-4')) {
                product_block.classList.remove('col-3')||product_block.classList.remove('col-4');
                product_block.classList.add('col-6');
            }
        });
    }
    document.getElementById('three_items').onclick = function () {
        Array.prototype.forEach.call(product_blocks, function (product_block) {
            if (product_block.classList.contains('col-3')||product_block.classList.contains('col-6')) {
                product_block.classList.remove('col-3')||product_block.classList.remove('col-6');
                product_block.classList.add('col-4');
            }
        });
    }
    document.getElementById('four_items').onclick = function () {
        Array.prototype.forEach.call(product_blocks, function (product_block) {
            if (product_block.classList.contains('col-4')||product_block.classList.contains('col-6')) {
                product_block.classList.remove('col-4')||product_block.classList.remove('col-6');
                product_block.classList.add('col-3');
            }
        });
    }
</script>
@endsection
