@extends('layouts.admin_layout.admin_layout')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          
        </div><!-- /.container-fluid -->
      </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @forelse ($food as $food)
                @if (!$food['bar']->isEmpty())
                    
                <div class="col-md-4">
                    <div class="card">
                        <form action="{{route('admin.update.food.status')}}" method="post">
                            @csrf
                            <input type="hidden" name="order_id" value="{{$food->id}}">
                            <div class="card-header">
                                <h3 class="card-title">@if (!empty($food->table->id))Table No : 
                                    {{$food->table->table_no}}
                                @endif </h3>
                                <h3 class="card-title">@if (!empty($food->room->id))Room No : 
                                    {{$food->room->room_no}}
                                @endif </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <ul class="products-list product-list-in-card pl-2 pr-2">
                                    @foreach ($food['bar'] as $item)
                                    <li class="item">
                                    <div class="product-info">
                                        <a href="javascript:void(0)" class="product-title">{{$item->item}}
                                        <span class="badge badge-warning float-right">{{$item->status}}</span></a>
                                        <span class="product-description">
                                            Qty({{$item->quantity}})
                                        </span>
                                    </div>
                                    </li>
                                    <?php 
                                    $status = $item->status;
                                    ?>
                                    @endforeach
                                    <!-- /.item -->
                                </ul>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <select name="status" id=""  style="
                                    display: inline;
                                    width: 120px;
                                    height: calc(2.25rem + 2px);
                                    padding: 0.375rem 0.75rem;
                                    font-size: 1rem;
                                    font-weight: 400;
                                    line-height: 1.5;
                                    color: #495057;
                                    background-color: #fff;
                                    background-clip: padding-box;
                                    border: 1px solid #ced4da;
                                    border-radius: 0.25rem;
                                    box-shadow: inset 0 0 0 transparent;
                                    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
                                ">
                                <option value="New" @if ( $status == "New" )
                                selected=""
                                @endif>New</option>
                                <option value="Cooking"@if ( $status == "Cooking" )
                                selected=""
                                @endif>Cooking</option>
                                <option value="Done"
                                @if ( $status == "Done" )
                                selected=""
                                @endif>Done</option>
                                </select>
                                <button class="btn btn-primary mx-5">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
                @endif

                @empty
                @endforelse
            </div>
        </div>
    </section>
</div>
@endsection