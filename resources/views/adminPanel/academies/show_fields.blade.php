<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/academies.fields.id').':') !!}
    <b>{{ $academy->id }}</b>
</div>

<!-- Icon Field -->
<div class="form-group">
    {!! Form::label('icon', __('models/academies.fields.icon').':') !!}
    <img src="{{$academy->icon_thumbnail_path}}" alt="" width="100">
</div>

<!-- Branch Id Field -->
<div class="form-group">
    {!! Form::label('branch_id', __('models/academies.fields.branch_id').':') !!}
    <b>{{ $academy->branch->name ?? '' }}</b>
</div>


<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', __('models/academies.fields.name').':') !!}
    <b>{{ $academy->name }}</b>
</div>


<!-- About Field -->
<div class="form-group">
    {!! Form::label('about', __('models/academies.fields.about').':') !!}
    <b>{!! $academy->about !!}</b>
</div>


<!-- Team Field -->
<div class="form-group">
    {!! Form::label('team', __('models/academies.fields.team').':') !!}
    <b>{!! $academy->team !!}</b>
</div>




<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/academies.fields.created_at').':') !!}
    <b>{{ $academy->created_at }}</b>
</div>


<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/academies.fields.updated_at').':') !!}
    <b>{{ $academy->updated_at }}</b>
</div>

<br>
<hr>
<h3>Academy Photos</h3>
<br>
 <div class="academy-photos d-flex">
     @foreach ($academy->photos as $photo)
         <div class="photo image-thumbnail m-2">
             <img src="{{$photo->photo_original_path}}" alt="" width="200">
         </div>
     @endforeach
 </div>
<br>
<hr>
<h3>Academy Times</h3>
<br>
<div class="academy-schedules d-flex">
    <table class="table">
        <thead>
            <tr>
                <td>Day</td>
                <td>From</td>
                <td>To</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($academy->schedules as $time)
            <tr>
                <td>{{$time->day}}</td>
                <td>{{$time->from}}</td>
                <td>{{$time->to}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<br>
<hr>
<h3>Academy Times</h3>
<br>
<div class="academy-subscriptions">
   <table class="table">
       <thead>
           <tr>
               <th>User</th>
               <th>Age</th>
               <th>Gender</th>
           </tr>
       </thead>
       <tbody>
           @foreach ($academy->subscriptions as $subscriber)
           <tr>
               <td scope="row">{{$subscriber->user->first_name ?? ''}} {{$subscriber->user->last_name ?? ''}}</td>
               <td>{{$subscriber->age}}</td>
               <td>{{$subscriber->gender}}</td>
           </tr>
           @endforeach
       </tbody>
   </table>
</div>
