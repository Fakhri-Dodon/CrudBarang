@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col">
            <div class="card mt-3">
                <div class="card-body">
                    <form action="{{ route('beli.store')}}" method="POST" ecrtype="multipart/form-data">
                        @csrf
                        <h3>Beli</h3>
                        <div class="row justify-content-center px-3" id="form-container">
                            <div class="row card mb-3">
                                <div class="col-12 mb-3">
                                    <div class="form-group mt-3">
                                        <label for="">Nama Barang: </label>
                                        <select name="barang[]" id="barang" class="form-control barang">
                                            <option value="" selected disabled>Pilih Barang</option>
                                            @foreach($barang as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 mb-3" style="display: none" id="divBarang">
                                    <div class="form-group">
                                        <label for="">Harga : </label>
                                        {{-- <input type="number" value="{{ $data->harga }}" class="form-control" id="harga"> --}}
                                        <div id="harga"></div>
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="">Quantity: </label>
                                        <input name="qty[]" id="qty" type="number" class="form-control qty">
                                    </div>
                                </div>
                                <div class="column mb-2">
                                    <button type="button" id="add-form" class="btn btn-secondary add">Tambah</button>
                                    <button type="button" id="remove-form" class="btn btn-danger">Remove</button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="">Total: </label>
                                    <input name="unit" type="text" class="form-control total">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <p>Jumlah barang yang ditambahkan: <span id="counter">1</span></p>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Beli</button>
                        <a class="btn btn-secondary" href="{{ route('beli.index') }}">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    
    document.addEventListener('DOMContentLoaded', function(){
        // Deklarasi variabel counter di luar fungsi $(document).ready() agar bisa diakses secara global
        var counter = 1;
    
        // Function to convert input value to uppercase
        function convertToUppercase(input) {
            input.addEventListener('input', function() {
                this.value = this.value.toUpperCase(); // Convert input value to uppercase
            });
        }
    
        // Convert input values to uppercase for the first form
        document.querySelectorAll('.barang, .qty, .total, .btn').forEach(function(input) {
            convertToUppercase(input);
        });
    
        // Function to remove form container
        function removeFormContainer(button) {
            var container = button.closest('.row');
            container.parentNode.removeChild(container);
            updateCounter(); // Update counter after removing form
        }
    
        // Function to update counter
        function updateCounter() {
            var forms = document.querySelectorAll('#form-container .row');
            counter = forms.length; // Update counter value
            document.getElementById('counter').textContent = counter;
            toggleAddInputButton(); // Toggle add input button based on the number of forms
        }
    
        // Function to toggle add input button
        function toggleAddInputButton() {
            var addButton = document.getElementById('add-form');
            addButton.disabled = false; // Selalu aktif
        }
    
        // Function to add new input container
        function addInputContainer() {
            var formContainer = document.getElementById('form-container');
            var newFormContainer = formContainer.firstElementChild.cloneNode(true); // Clone the first form container
    
            // Clear input values in the new container
            newFormContainer.querySelectorAll('select, input').forEach(function(input) {
                input.value = '';
            });
    
            // Convert input values to uppercase for the new form
            newFormContainer.querySelectorAll('.barang, .qty, .total, .btn').forEach(function(input) {
                convertToUppercase(input);
            });
    
            // Add event listener for the remove button of the new form
            var removeButton = newFormContainer.querySelector('.btn-danger');
            removeButton.addEventListener('click', function() {
                removeFormContainer(this);
            });
    
            // Update name attributes to ensure uniqueness
            var containerIndex = document.querySelectorAll('.input-container').length;
            newFormContainer.querySelectorAll('select, input').forEach(function(input) {
                var inputName = input.getAttribute('name');
                inputName = inputName.replace('[0]', '[' + containerIndex + ']');
                input.setAttribute('name', inputName);
            });
    
            formContainer.appendChild(newFormContainer); // Append the new form container to the form container
            updateCounter(); // Update counter after adding form
        }
    
        // Add event listener to "Add form" button
        document.getElementById('add-form').addEventListener('click', function() {
            addInputContainer();
        });
    
        // Add event listener for the remove button of the initial form
        var removeButton = document.querySelector('#form-container .btn-danger:not(:first-child)');
        removeButton.addEventListener('click', function() {
            removeFormContainer(this);
        });

        $(document).ready(function() {
            $(".barang").on("change", function () {
            const barang = document.getElementById('barang').value;
            const harga = document.getElementById('harga').value;
            console.log('harga:', harga);
            console.log('Selected ID:', barang);

                $.ajax({
                    type: 'GET',
                    url: "{{ route('beli.getBarang') }}",
                    dataType: "json",
                    data: {id: barang},
                    success: function(response) {
                        console.log('AJAX success response:', response);
                        document.getElementById('divBarang').style.display='block';
                        $('#harga').html(response.harga);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error("AJAX error: ", textStatus, errorThrown); // Debugging line to log the error
                        console.error("Response text: ", jqXHR.responseText); // Debugging line to see the response text
                        $('#harga').html("Error fetching harga");
                    }
                });
            });
        });
    });

</script>


@endsection