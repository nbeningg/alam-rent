<div class="search_section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="search_taital">Cari Sesuai Kategori!</h1>
                <p class="search_text">Gunakan pencarian ini untuk memudahkan anda menemukan barang sesuai kategorinya
                </p>
                <!-- select box section start -->
                <form action="{{ route('search') }}" method="GET"> <!-- Form untuk pencarian -->
                    <div class="container">
                        <div class="select_box_section">
                            <div class="select_box_main">
                                <div class="row">
                                    <div class="col-md-6 select-outline">
                                        <div class="styled-select">
                                            <select name="category"
                                                class="mdb-select md-form md-outline colorful-select dropdown-primary">
                                                <option value="" disabled selected>Kategori</option>
                                                <option value="1">Ransel</option>
                                                <option value="2">Pakaian</option>
                                                <option value="3">Sepatu</option>
                                                <option value="4">Tenda</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="search_btn">
                                        <button type="submit">Search Now</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- select box section end -->
            </div>
        </div>
    </div>
</div>


<div class="gallery_section layout_padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (isset($category))
                    @switch($category)
                        @case('1')
                            <h1 class="gallery_taital">Our Best Backpacking Packs Offers</h1>
                        @break

                        @case('2')
                            <h1 class="gallery_taital">Our Best Clothing Offers</h1>
                        @break

                        @case('3')
                            <h1 class="gallery_taital">Our Best Footwear Offers</h1>
                        @break

                        @case('4')
                            <h1 class="gallery_taital">Our Best Tent Offers</h1>
                        @break

                        @default
                            <h1 class="gallery_taital">Our best offers</h1>
                    @endswitch
                @else
                    <h1 class="gallery_taital">Our best offers</h1>
                @endif

            </div>
        </div>
        <div class="gallery_section_2">
            <div class="row">
                @isset($products)
                    @foreach ($products as $category => $categoryProducts)
                        @foreach ($categoryProducts as $product)
                            @php
                                // Dapatkan semua booking yang terkait dengan produk ini
                                $bookings = \App\Models\Booking::where('category', $category)
                                    ->where('product_id', $product->id)
                                    ->get();

                                // Inisialisasi variabel status default
                                $status = 'available';

                                // Periksa apakah ada pemesanan yang berhubungan dengan produk ini
                                if ($bookings->isNotEmpty()) {
                                    // Ambil status pemesanan yang paling baru
                                    $latestStatus = $bookings->last()->status;

                                    // Atur status berdasarkan status pemesanan yang paling baru
                                    switch ($latestStatus) {
                                        case 'ongoing':
                                            $status = 'ongoing';
                                            break;
                                        case 'cancelled':
                                        case 'returned_late':
                                        case 'returned_on_time':
                                            $status = 'not_available';
                                            break;
                                    }
                                }
                            @endphp

                            <div class="col-md-4">
                                <div class="gallery_box">
                                    <div class="gallery_img">
                                        <img src="{{ Storage::url($product->gambar) }}" alt="{{ $product->merk }}">
                                    </div>
                                    <h3 class="types_text">{{ $product->merk }}</h3>
                                    <p class="looking_text">Start per day
                                        Rp.{{ number_format($product->harga, 0, ',', '.') }}</p>
                                    <div class="read_bt">
                                        @if ($status == 'ongoing')
                                            <a href="#" class="booked-btn">Booked</a>
                                        @else
                                            <a
                                                href="{{ route('single', ['category' => $category, 'id' => $product->id]) }}">Book
                                                Now</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                @else
                    {{-- Ambil tiga entitas acak dari setiap kategori --}}
                    @php
                        $randomRansels = App\Models\Ransel::inRandomOrder()->limit(3)->get();
                        $randomPakaians = App\Models\Pakaian::inRandomOrder()->limit(3)->get();
                        $randomSepatus = App\Models\Sepatu::inRandomOrder()->limit(3)->get();
                        $randomTendas = App\Models\Tenda::inRandomOrder()->limit(3)->get();
                    @endphp

                    {{-- Tampilkan produk acak dari setiap kategori --}}
                    @foreach ($randomRansels as $randomRansel)
                        <div class="col-md-4">
                            <div class="gallery_box">
                                <div class="gallery_img">
                                    <img src="{{ Storage::url($randomRansel->gambar) }}" alt="{{ $randomRansel->merk }}">
                                </div>
                                <h3 class="types_text">{{ $randomRansel->merk }}</h3>
                                <p class="looking_text">Start per day
                                    Rp.{{ number_format($randomRansel->harga, 0, ',', '.') }}</p>
                                <div class="read_bt">
                                    @php
                                        $bookings = \App\Models\Booking::where('category', 'ransel')
                                            ->where('product_id', $randomRansel->id)
                                            ->get();
                                        $status = 'book_now';
                                        if ($bookings->isNotEmpty()) {
                                            $latestStatus = $bookings->last()->status;
                                            if (
                                                $latestStatus === 'cancelled' ||
                                                $latestStatus === 'returned_late' ||
                                                $latestStatus === 'returned_on_time'
                                            ) {
                                                $status = 'book_now';
                                            } elseif ($latestStatus === 'ongoing') {
                                                $status = 'booked';
                                            }
                                        }
                                    @endphp
                                    @if ($status === 'booked')
                                        <a href="#" class="booked-btn">Booked</a>
                                    @else
                                        <a
                                            href="{{ route('single', ['category' => 'ransel', 'id' => $randomRansel->id]) }}">Book
                                            Now</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach

                    @foreach ($randomPakaians as $randomPakaian)
                        <div class="col-md-4">
                            <div class="gallery_box">
                                <div class="gallery_img">
                                    <img src="{{ Storage::url($randomPakaian->gambar) }}"
                                        alt="{{ $randomPakaian->merk }}">
                                </div>
                                <h3 class="types_text">{{ $randomPakaian->merk }}</h3>
                                <p class="looking_text">Start per day
                                    Rp.{{ number_format($randomPakaian->harga, 0, ',', '.') }}</p>
                                <div class="read_bt">
                                    @php
                                        $bookings = \App\Models\Booking::where('category', 'pakaian')
                                            ->where('product_id', $randomPakaian->id)
                                            ->get();
                                        $status = 'book_now';
                                        if ($bookings->isNotEmpty()) {
                                            $latestStatus = $bookings->last()->status;
                                            if (
                                                $latestStatus === 'cancelled' ||
                                                $latestStatus === 'returned_late' ||
                                                $latestStatus === 'returned_on_time'
                                            ) {
                                                $status = 'book_now';
                                            } elseif ($latestStatus === 'ongoing') {
                                                $status = 'booked';
                                            }
                                        }
                                    @endphp
                                    @if ($status === 'booked')
                                        <a href="#" class="booked-btn">Booked</a>
                                    @else
                                        <a
                                            href="{{ route('single', ['category' => 'pakaian', 'id' => $randomPakaian->id]) }}">Book
                                            Now</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach

                    @foreach ($randomSepatus as $randomSepatu)
                        <div class="col-md-4">
                            <div class="gallery_box">
                                <div class="gallery_img">
                                    <img src="{{ Storage::url($randomSepatu->gambar) }}" alt="{{ $randomSepatu->merk }}">
                                </div>
                                <h3 class="types_text">{{ $randomSepatu->merk }}</h3>
                                <p class="looking_text">Start per day
                                    Rp.{{ number_format($randomSepatu->harga, 0, ',', '.') }}</p>
                                <div class="read_bt">
                                    @php
                                        $bookings = \App\Models\Booking::where('category', 'sepatu')
                                            ->where('product_id', $randomSepatu->id)
                                            ->get();
                                        $status = 'book_now';
                                        if ($bookings->isNotEmpty()) {
                                            $latestStatus = $bookings->last()->status;
                                            if (
                                                $latestStatus === 'cancelled' ||
                                                $latestStatus === 'returned_late' ||
                                                $latestStatus === 'returned_on_time'
                                            ) {
                                                $status = 'book_now';
                                            } elseif ($latestStatus === 'ongoing') {
                                                $status = 'booked';
                                            }
                                        }
                                    @endphp
                                    @if ($status === 'booked')
                                        <a href="#" class="booked-btn">Booked</a>
                                    @else
                                        <a
                                            href="{{ route('single', ['category' => 'sepatu', 'id' => $randomSepatu->id]) }}">Book
                                            Now</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach

                    @foreach ($randomTendas as $randomTenda)
                        <div class="col-md-4">
                            <div class="gallery_box">
                                <div class="gallery_img">
                                    <img src="{{ Storage::url($randomTenda->gambar) }}" alt="{{ $randomTenda->merk }}">
                                </div>
                                <h3 class="types_text">{{ $randomTenda->merk }}</h3>
                                <p class="looking_text">Start per day
                                    Rp.{{ number_format($randomTenda->harga, 0, ',', '.') }}</p>
                                <div class="read_bt">
                                    @php
                                        $bookings = \App\Models\Booking::where('category', 'tenda')
                                            ->where('product_id', $randomTenda->id)
                                            ->get();
                                        $status = 'book_now';
                                        if ($bookings->isNotEmpty()) {
                                            $latestStatus = $bookings->last()->status;
                                            if (
                                                $latestStatus === 'cancelled' ||
                                                $latestStatus === 'returned_late' ||
                                                $latestStatus === 'returned_on_time'
                                            ) {
                                                $status = 'book_now';
                                            } elseif ($latestStatus === 'ongoing') {
                                                $status = 'booked';
                                            }
                                        }
                                    @endphp
                                    @if ($status === 'booked')
                                        <a href="#" class="booked-btn">Booked</a>
                                    @else
                                        <a href="{{ route('single', ['category' => 'tenda', 'id' => $randomTenda->id]) }}">Book
                                            Now</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endisset
            </div>
        </div>
    </div>
</div>
