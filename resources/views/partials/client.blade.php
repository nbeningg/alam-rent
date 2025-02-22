<div class="client_section layout_padding">
    <div class="container">
        <div id="custom_slider" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                @foreach ($testimonies->chunk(2) as $chunk)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                        <div class="row">
                            <div class="col-md-12">
                                <h1 class="client_taital">What Says Customers</h1>
                            </div>
                        </div>
                        <div class="client_section_2">
                            <div class="row">
                                @foreach ($chunk as $testimony)
                                    <div class="col-md-6">
                                        <div class="client_taital_box">
                                            <div class="client_img">
                                                <img src="{{ Storage::url($testimony->gambar) }}" alt="Client Image">
                                            </div>
                                            <h3 class="moark_text">{{ $testimony->nama }}</h3>
                                            <p class="client_text">{{ $testimony->testimoni }}</p>
                                        </div>
                                        <div class="quick_icon">
                                            <img src="{{ asset('template/images/quick-icon.png')}}" alt="Quick Icon">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#custom_slider" role="button" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="carousel-control-next" href="#custom_slider" role="button" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>
        </div>
    </div>
</div>

<!-- Include jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>


{{-- Carousel Controls: carousel-control-prev dan carousel-control-next adalah tautan yang mengatur navigasi 
slide sebelumnya dan berikutnya dalam carousel. Mereka terhubung ke #custom_slider dengan atribut href="#custom_slider --}}
<script>
    $(document).ready(function(){
        $('#custom_slider').carousel({
            interval: false
        });

        $('.carousel-control-next').click(function() {
            $('#custom_slider').carousel('next');
        });

        $('.carousel-control-prev').click(function() {
            $('#custom_slider').carousel('prev');
        });
    });
</script>
