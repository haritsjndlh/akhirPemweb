@extends('layouts.app')

@section('sidebar')
<button id="close-btn">
    <span class="material-symbols-sharp">close</span>
</button>

<div class="sidebar">
    <a href="/home">
        <span class="material-symbols-sharp">dashboard</span>
        <h4>Dashboard</h4>
    </a>
    <a href="/transaksi"  class="active">
        <span class="material-symbols-sharp">account_balance_wallet</span>
        <h4>Transaction</h4>
    </a>
    <a href="#">
        <span class="material-symbols-sharp">receipt_long</span>
        <h4>Report</h4>
    </a>
</div>
<!-- end sidebar -->
@endsection

@section('mid-cont')
<div class="recent-transactions">
    <div class="header">
        <h2>Recent Transaction</h2>
        <button type="button" class="add" data-bs-toggle="modal" data-bs-target="#transmodal1">
            <span class="material-symbols-sharp">add</span>
        </button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="transmodal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Transaksi</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ action('App\Http\Controllers\TransController@store') }}">

                {{ csrf_field() }}
            <div class="modal-body">
                    @csrf

                    <div class="row mb-3">
                        <label for="deskripsi" class="col-md-4 col-form-label text-md-end">{{ __('Deskripsi') }}</label>

                        <div class="col-md-6">
                            <input id="deskripsi" type="text" class="form-control" name="deskripsi" value="{{ old('deskripsi') }}" placeholder="Education" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="fee" class="col-md-4 col-form-label text-md-end">{{ __('Fee') }}</label>

                        <div class="col-md-6">
                            <input id="fee" type="text" class="form-control" name="fee" value="{{ old('fee') }}" placeholder="-500000" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="tanggal" class="col-md-4 col-form-label text-md-end">{{ __('Tanggal') }}</label>
                        <div class="col-md-6">
                            <input id="tanggal" type="date" class="form-control" name="tanggal" value="{{ old('tanggal') }}" >
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="category" class="col-md-4 col-form-label text-md-end">{{ __('Category') }}</label>

                        <div class="col-md-6">
                            <select id="category" type="text" class="form-control" name="category" value="{{ old('BagdeColor') }}">
                                <option value="">--pilih--</option>
                                @foreach ($category as $item)
                                    <option value={{ $item->id }}>{{ $item->category }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <div>
                    <button type="submit" class="btn btn-info">
                        {{ __('Simpan') }}
                    </button>
                </div>
            </form>
            </div>
        </div>
        </div>
    </div>
    {{-- end modal 1 --}}
        
    <?php if (count($transaksi) == 0) {
        echo "<div class='transaction'> <a href='transaksi/' style='font-size:1rem; color:gray; font-family: poppins, sans-serif;'>Buat Transaksi Pertamamu Sekarang</a> </div>";
    }
    else { ?>
        @foreach ($transaksi as $item)
        <div class="transaction" type="button" data-bs-toggle="modal" data-bs-target="#UpdateTrans-{{ $item->id }}">
            <div class="service">
                <div class="icon {{ $item->category->background }}">
                    <?php echo "{$item->category->description}"; ?>
                </div>
                <div class="details">
                    <h4>{{ $item->category->category }}</h4>
                    <p>{{ $item->category->tanggal}}</p>
                </div>
            </div>
            <div class="card-details">
                <div class="details">
                    <p>detail</p>
                    <small class="text-muted">{{ $item->description }}</small>
                </div>
            </div>
            <h4>Rp {{ $item->fee }}</h4>
        </div>    
        @endforeach
        <!-- END TRANSACTION -->
        {{-- modal 2 --}}
    @foreach ($transaksi as $i)
    <!-- Modal -->
    <div class="modal fade" id="UpdateTrans-{{ $i->id }}" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="UpdateModalLabel">Transaksi</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ url('transaksi/'.$i->id) }}">

                {{ csrf_field() }}

                @method("PATCH")

            <div class="modal-body">
                    @csrf

                    <div class="row mb-3">
                        <label for="deskripsi" class="col-md-4 col-form-label text-md-end">{{ __('Deskripsi') }}</label>

                        <div class="col-md-6">
                            <input id="deskripsi" type="text" class="form-control" name="deskripsi" value="{{ $i->description }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="fee" class="col-md-4 col-form-label text-md-end">{{ __('Fee') }}</label>

                        <div class="col-md-6">
                            <input id="fee" type="text" class="form-control" name="fee" value="{{ $i->fee }}" >
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="tanggal" class="col-md-4 col-form-label text-md-end">{{ __('Tanggal') }}</label>

                        <div class="col-md-6">
                            <input id="tanggal" type="date" class="form-control" name="tanggal" value="{{ $i->Tanggal }}" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="category" class="col-md-4 col-form-label text-md-end">{{ __('Category') }}</label>

                        <div class="col-md-6">
                            <select id="category" type="text" class="form-control" name="category" value="{{ $i->id }}" required>
                                <option value="">{{ $i->category->category }}</option>
                                @foreach($category as $item)
                                    echo <option value={{ $item->id }}>{{ $item->category }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <div>
                    <button type="submit" class="btn btn-info">
                        {{ __('Simpan') }}
                    </button>
                </div>
            </form>
            <form method="POST" action="{{ url('transaksi/' .$i->id) }}" accept-charset="UTF-8">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger" title="Delete Transaction" onclick="return confirm('Confirm delete?')"><i class="fa fa-trash-o" aria-hidden="true">Delete</button>
            </form>
            </div>
        </div>
        </div>
    </div>
     @endforeach
    {{-- end modal 2 --}}
    <?php } ?>

</div>
@endsection