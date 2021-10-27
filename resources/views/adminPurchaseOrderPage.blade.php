@extends('adminPageLayout')
@section('content')

<style>

    .addButton{
        border-radius: 4px;
        cursor: pointer;
    }

    .addButton:hover{
        background-color: #E1e4e5;
    }

</style>

<!--Page topic-->

<div class="container-fluid">
        <div class="row">
          <div class="col-sm-11">
            <div class="p-1 pageTopic"> <a href="{{ url('adminHomePage') }}">Home</a> / <a href="#" class="currentPage">Purchase Order</a></div>
          </div>
        </div>
</div>

<!--Page topic-->

<div class="container-fluid border addAdminContent">
    <div class="row bg-light row1"> 
        <div class="col-sm-10">
            <div class="p-3"><b>Purchase Order List</b></div>
        </div>
        <div class="col-sm">
            <div class="p-3">
                <Button type="button" class="button addButton" data-toggle="modal" data-target="#exampleModal">New+</Button>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                </div>
                <div class="modal-footer">
                </div>
                </div>
            </div>
            </div>
            <!-- Modal -->

        </div>
    </div>
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Status</th>
                <th scope="col">Vendor</th>
                <th scope="col">Option</th>
                </tr>
            </thead>
        <tbody>
            <tr>

                <td>
                    <img src="" alt="">
                    <a href=""></a>
                </td>
                <td></td>
                <td></td>
                <td>
                    <button>Delete</button>
                </td>
            </tr>

        </tbody>
        </table>
    </div>
    

</div>

@endsection