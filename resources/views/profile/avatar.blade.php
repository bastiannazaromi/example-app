@extends('layouts.main')

@section('title', $title)
@section('page_heading', $title)

@section('container')
    <div class="row">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">

                    <div id="ajaxAlert" class="alert d-none" role="alert"></div>

                    <div class="mb-4">
                        <img id="avatarPreview"
                            src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('images/default-avatar.png') }}"
                            class="rounded-circle img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;">
                    </div>

                    <form id="avatarForm" enctype="multipart/form-data">
                        <div class="mb-3 text-start">
                            <label class="form-label">Pilih Foto</label>
                            <input type="file" name="avatar" id="avatarInput" class="form-control" required
                                accept=".jpg, .jpeg, .png">
                            <div class="invalid-feedback" id="errorMessage"></div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100" id="btnSubmit">
                            <span class="spinner-border spinner-border-sm d-none" id="loadingSpinner"></span>
                            Upload
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#avatarForm').on('submit', function(e) {
                e.preventDefault();

                let formData = new FormData(this);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });

                $.ajax({
                    url: '/profile/avatar/update',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#btnSubmit').attr('disabled', true);
                        $('#loadingSpinner').removeClass('d-none');
                        $('#avatarInput').removeClass('is-invalid');
                        $('#ajaxAlert').addClass('d-none');
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#ajaxAlert').removeClass('d-none alert-danger').addClass(
                                'alert-success').text(response.message);
                            $('#avatarPreview').attr('src', response.avatar_url);
                            $('#avatarForm')[0].reset();
                        }
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        $('#ajaxAlert').removeClass('d-none alert-success').addClass(
                            'alert-danger').text('Validasi Gagal!');

                        if (errors && errors.avatar) {
                            $('#avatarInput').addClass('is-invalid');
                            $('#errorMessage').text(errors.avatar[0]);
                        }
                    },
                    complete: function() {
                        $('#btnSubmit').attr('disabled', false);
                        $('#loadingSpinner').addClass('d-none');
                    }
                });
            });
        });
    </script>
@endsection
