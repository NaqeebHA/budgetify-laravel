@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <h1 class="title-text">Events</h1>
    <table class="table table-bordered" id="category-list">
        <thead>    
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th colspan=2>Edit/Delete</th>
            </tr> 
        </thead>   
        <tbody>
        </tbody>
    </table>
</div>
<div id="response"></div>

@endsection