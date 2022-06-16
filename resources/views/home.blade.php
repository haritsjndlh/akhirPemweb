@extends('layouts.app')

@section('sidebar')
<button id="close-btn">
    <span class="material-symbols-sharp">close</span>
</button>

<div class="sidebar">
    <a href="/home" class="active">
        <span class="material-symbols-sharp">dashboard</span>
        <h4>Dashboard</h4>
    </a>
    <a href="/transaksi">
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
<div class="header">
    <h1>Overview</h1>
    <input type="date">
</div>

<div class="wallets">
    <!-- CARD ONE -->
    <div  class="wallet" data-bs-toggle="modal" data-bs-target="#walletModal">
        <div class="top">
            <div class="left">
                <h2>{{ Auth::user()->name_wallet }}</h2>
            </div>
            <?php if (Auth::user()->saldo != null && Auth::user()->saldo != null) {
                echo "<img src='love.svg' class='right'>";}?>
        </div>
        <div class="middle">
            <!-- jumlh isi dompet -->
            @foreach ($totalin as $in)
            @foreach ($totalex as $ex)
            <h1><?php if (Auth::user()->saldo != null) {
                echo "Rp ". ((Auth::user()->saldo) + ($ex->fee) - ($in->fee));
            }  else{
                echo "Atur Saldo dan Nama Dompet Anda";
            }?> </h1>
            @endforeach
            @endforeach
        </div>
        <div class="bottom">
            <div class="left">
                <small>Owner</small>
                <h5>{{ Auth::user()->name }}</h5>
            </div>
            <div class="right">
                <div class="kurs">
                    <small>Mata Uang</small>
                    <h5>IDR/Rp</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- END CARD ONE -->

    <div class="modal fade" id="walletModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Fast Payment</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ url('home/'.Auth::user()->id.'/edit') }}">

                {{ csrf_field() }}
                @method("HEAD")

            <div class="modal-body">
                    @csrf

                    <div class="row mb-3">
                        <label for="namaDompet" class="col-md-4 col-form-label text-md-end">{{ __('Nama Dompet') }}</label>

                        <div class="col-md-6">
                            <input id="namaDompet" type="text" class="form-control" name="namaDompet" value="{{ Auth::user()->name_wallet }}" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="Saldo" class="col-md-4 col-form-label text-md-end">{{ __('Saldo') }}</label>

                        <div class="col-md-6">
                            <input id="Saldo" type="text" class="form-control" name="Saldo" value="{{ Auth::user()->saldo }}" required>
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

</div>
<!-- END OF CARDS -->

<div class="monthly-report">
    <div class="report">
        <h3>Income</h3>
        <div>
            @foreach ($totalin as $item)
            @if ($item->fee == null)
                <details><h1>-</h1></details>
            @else
                <details>
                    <h1>Rp {{ $item->fee }}</h1>
                </details>
            @endif
            @endforeach
        </div>
    </div>
    <!-- END OF INCOME -->
    <div class="report">
        <h3>Expenses</h3>
        <div>
            @foreach ($totalex as $item)
            @if ($item->fee == null)
                <details><h1>-</h1></details>
            @else
                <details>
                    <h1>Rp {{ $item->fee }}</h1>
                </details>
            @endif
            @endforeach
        </div>
    </div>
</div>
<!-- END OF MONTHLY REPORT -->

<div class="fast-payment">
    <h2>Fast Payment</h2>
    <div class="badgees">
        <!-- Button trigger modal -->
        <button type="button" class="badgee" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <span class="material-symbols-sharp">add</span>
        </button>
        
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Fast Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ action('App\Http\Controllers\HomeController@store') }}">

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
                                <input id="fee" type="text" class="form-control" name="fee" value="{{ old('fee') }}" placeholder="500000" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="badge" class="col-md-4 col-form-label text-md-end">{{ __('Badge Color') }}</label>

                            <div class="col-md-6">
                                <select id="badge" type="text" class="form-control" name="badge" value="{{ old('BagdeColor') }}">
                                    <option value="">--pilih--</option>
                                    @foreach ($badge as $item)
                                        <option value={{ $item->id }}>{{ $item->color }}</option>
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

        @foreach ($fp as $item)
        <button type="button" class="badgee" data-bs-toggle="modal" data-bs-target="#UpdateModal-{{ $item->id }}">
            <span class={{ $item->badge->description }}></span>
            <div>
                <h5>{{ $item->description }}</h5>
                <h4>Rp {{ $item->fee }}</h4>
            </div>
        </button>
        @endforeach
       
        @foreach ($fp as $i)
        <!-- Modal -->
        <div class="modal fade" id="UpdateModal-{{ $i->id }}" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="UpdateModalLabel">Fast Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ url('home/'.$i->id) }}">

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
                            <label for="badge" class="col-md-4 col-form-label text-md-end">{{ __('Badge Color') }}</label>

                            <div class="col-md-6">
                                <select id="badge" type="text" class="form-control" name="badge" value="{{ $i->id }}" required>
                                    <option value="">{{ $i->badge->color }}</option>
                                    @foreach($badge as $item)
                                        echo <option value={{ $item->id }}>{{ $item->color }}</option>
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
                <form method="POST" action="{{ url('home/' .$i->id) }}" accept-charset="UTF-8">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-danger" title="Delete Fast Payment" onclick="return confirm('Confirm delete?')"><i class="fa fa-trash-o" aria-hidden="true">Delete</button>
                </form>
                </div>
            </div>
            </div>
        </div>
         @endforeach
    </div>
</div>

<canvas id="chart"></canvas>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js" integrity="sha512-sW/w8s4RWTdFFSduOTGtk4isV1+190E/GghVffMA9XczdJ2MDzSzLEubKAs5h0wzgSJOQTRYyaz73L3d6RtJSg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <script>
        const chart = document.querySelector("#chart").getContext('2d');
        //  create a new chart instance
        new Chart(chart, {
            type: 'doughnut',
            data: {
            labels: ['Income', 'Expense'],
            datasets: [
            {
                label: 'Report',
                data: [$totalin, $totalex],
                backgroundColor : [ 'rgb(255, 99, 132)','rgb(54, 162, 235)'],
                hoverOffset : 4
            }]
        }
        });

        // show or hide sidebar
        const menuBtn = document.querySelector('#menu-btn');
        const closeBtn = document.querySelector('#close-btn');
        const sidebar = document.querySelector('aside');

        menuBtn.addEventListener('click', ()=>{
            sidebar.style.display = 'block';
        })

        closeBtn.addEventListener('click', ()=>{
            sidebar.style.display = 'none';
        })
    </script>
@endsection

@section('right-cont')
<div class="recent-transactions">
    <div class="header">
        <h2>Recent Transaction</h2>
        <a href="/transaksi">More <span class="material-symbols-sharp">chevron_right</span></a>
    </div>
        
    <?php if (count($transaksi) == 0) {
        echo "<div class='transaction'> <a href='transaksi/' style='font-size:1rem; color:gray; font-family: poppins, sans-serif;'>Buat Transaksi Pertamamu Sekarang</a> </div>";
    }

    else { ?>
        @foreach ($transaksi as $item)
        <div class="transactionn">
            <div class="service">
                <div class="icon {{ $item->category->background }}">
                    <?php echo "{$item->category->description}"; ?>
                </div>
                <div class="details">
                    <h4>{{ $item->category->category }}</h4>
                    <p>{{ $item->category->tanggal }}</p>
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
    <?php } ?>

</div>
@endsection
