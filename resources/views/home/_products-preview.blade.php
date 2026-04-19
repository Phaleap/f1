    {{-- ── PRODUCTS ── --}}
    <section id="products-preview">
        <p class="section-eyebrow">Shop Now</p>
        <h2 class="section-title">Featured Products</h2>
        <div class="products-grid">
            @forelse($products ?? [] as $product)
                <a href="{{ route('products.show', $product) }}" class="product-card" style="text-decoration:none;color:inherit">
                    <div class="product-card-img">
                        @if($product->mainImage)
                            <img src="{{ asset('storage/' . $product->mainImage->image_url) }}"
                                 alt="{{ $product->product_name }}"
                                 loading="lazy">
                        @else
                            <span class="product-card-img-placeholder">No Image</span>
                        @endif
                        <div class="product-tag">F1 Official</div>
                    </div>
                    <div class="product-card-body">
                        <div class="product-card-name">{{ $product->product_name }}</div>
                        <div class="product-card-price"><span>$</span>{{ number_format($product->base_price, 2) }}</div>
                    </div>
                </a>
            @empty
                {{-- Skeleton placeholders when no products --}}
                @for($i = 0; $i < 4; $i++)
                    <div class="product-card" style="opacity:0.4;pointer-events:none">
                        <div class="product-card-img" style="background:#111"></div>
                        <div class="product-card-body">
                            <div class="product-card-name" style="background:#1a1a1a;height:12px;width:120px;border-radius:1px"></div>
                            <div class="product-card-price" style="background:#1a1a1a;height:20px;width:60px;border-radius:1px"></div>
                        </div>
                    </div>
                @endfor
            @endforelse
        </div>
    </section>