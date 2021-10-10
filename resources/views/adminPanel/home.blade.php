
@extends('adminPanel.layouts.app')

@section('breadcrumb')
<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
    <li class="breadcrumb-item active">  Dashboard </li>
</ul>
@endsection
@section('content')
    <div class="d-flex flex-column-fluid">
		<!--begin::Container-->
		<div class=" container ">
			<div class="row">
                <div class="col-lg-12">
                    <!--begin::Card-->
                    {{-- <div class="card card-custom gutter-b example example-compact">
                        <div class="card-header">
                            <h3 class="card-title">4GO</h3>
                        </div>
                        <div class="card-body">
                            <h2>We ignite opportunity by setting the world in motion</h2>
                            <p>Good things happen when people can move, whether across town or toward their dreams. Opportunities appear, open up, become reality. What started as a way to tap a button to get a ride has led to billions of moments of human connection as people around the world go all kinds of places in all kinds of ways with the help of our technology.</p>
                            <br><hr><br>
                            <h2>Sustainability</h2>
                            <p>4GO is committing to becoming a fully electric, zero-emission platform by 2040, with 100% of rides taking place in zero-emission vehicles, on public transit, or with micromobility. It is our responsibility as the largest mobility platform in the world to more aggressively tackle the challenge of climate change. We will do this by offering riders more ways to ride green, helping drivers go electric, making transparency a priority and partnering with NGOs and the private sector to help expedite a clean and just energy transition.</p>
                            <br><hr><br>
                            <h2>Rides and beyond</h2>
                            <p>In addition to giving riders a way to get from point A to point B, we're working to bring the future closer with self-driving technology and urban air transport, helping people order food quickly and affordably, removing barriers to healthcare, creating new freight-booking solutions, and helping companies provide a seamless employee travel experience.</p>
                            <br><hr><br>
                            <h2>Your safety drives us</h2>
                            <p>Whether you’re in the back seat or behind the wheel, your safety is essential. We are committed to doing our part, and technology is at the heart of our approach. We partner with safety advocates and develop new technologies and systems to help improve safety and help make it easier for everyone to get around.</p>

                        </div>
                    </div> --}}
                    <!--end::Card-->
                </div>
            </div>
        </div>
		<!--end::Container-->
    </div>
@endsection
