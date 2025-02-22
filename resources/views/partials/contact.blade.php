<div class="contact_section layout_padding">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="contact_taital">Get In Touch</h1>
            </div>
        </div>
        <!-- Alert messages and validation errors -->
        @if (session()->has('message'))
            <div class="alert alert-{{ session()->get('alert-type') }} alert-dismissible fade show" role="alert">
                {{ session()->get('message') }}
                
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <div class="container">
        <div class="contact_section_2">
            <form action="{{ route('contact/store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="mail_section_1">
                            <input type="text" class="mail_text" placeholder="Name" name="nama" value="{{ old('nama') }}">
                            <input type="text" class="mail_text" placeholder="Email" name="email" value="{{ old('email') }}">
                            <input type="text" class="mail_text" placeholder="Phone Number" name="phone" value="{{ old('phone') }}">
                            <textarea class="massage-bt" placeholder="Massage" rows="5" id="comment" name="pesan">{{ old('pesan') }}</textarea>
                            <div class="send_bt">
                                <button type="submit" class="btn btn-primary">Send</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
