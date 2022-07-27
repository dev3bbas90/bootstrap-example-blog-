@extends('layouts.master')

@section('title')
Statistics
@endsection

@section('stat_link')
id='hdr_link_select'
@endsection

@section('hide_logoimg2')
display:none;
@endsection

@section('logoimg2')
  <img src="/upload/car1.jpg" id="logo_img">
@endsection
@section('hide_sidebar')
id='hide_sidebar'
@endsection

@section('content')
<div class="row" style="margin-right:-150px;">

  <div class="col col-md-18 text-center" style="text-align: center;">  
      <div class="text-center"><h2>Statistics </h2></div>
      <table id="control_table" class="table table-hover">
        <thead>
          <tr>
            <th>Role</th><th>Count</th><th>Level</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td> Users</td><td>{{$users}}</td><td>-</td>
          </tr>
           <tr>
            <td> Posts</td><td>{{$posts_count}}</td><td>-</td>
          </tr>
           <tr>
            <td> comments</td><td>{{$comments}}</td><td>-</td>
          </tr>
          <tr>
            <td> Most Commented</td><td>{{$most_commented->name}} ({{$most_commented->comments_count}}  comments) </td><td>-</td>
          </tr>
          <tr>
            <td> Most liked</td><td>{{$most_liked->name}} ({{$most_liked->likes_count}}  likes) </td><td>-</td>
          </tr>
          
          <tr>
            <td> Most Sharable </td><td>{{$most_sharable}} ({{$shares_count_for_sharable}}) posts </td><td>-</td>
          </tr>
           <tr>
            <td> Most Active User </td><td>{{$most_active_user}} </td><td>-</td>
          </tr>
        </tbody>
      </table>
    </div>
</div>


@section('footer_id1')
<div id="gab_footer">
@endsection

@section('footer_id2')
</div>
@endsection
@stop