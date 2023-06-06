</div>
<!-- END MAIN CONTENT-->
<!-- END PAGE CONTAINER-->
</div>

</div>

<!-- Jquery JS-->
<script src="{{ asset('admin/vendor/jquery-3.2.1.min.js') }}"></script>
<!-- Bootstrap JS-->
<script src="{{ asset('admin/vendor/bootstrap-4.1/popper.min.js') }}"></script>
<script src="{{ asset('admin/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>


<!-- Vendor JS       -->
<script src="{{ asset('admin/vendor/slick/slick.min.js') }}"></script>
<script src="{{ asset('admin/vendor/wow/wow.min.js') }}"></script>
<script src="{{ asset('admin/vendor/animsition/animsition.min.js') }}"></script>
<script src="{{ asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
<script src="{{ asset('admin/vendor/counter-up/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('admin/vendor/counter-up/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('admin/vendor/circle-progress/circle-progress.min.js') }}"></script>
<script src="{{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('admin/vendor/chartjs/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('admin/vendor/select2/select2.min.js') }}"></script>
<script src="{{ asset('admin/ckeditor/ckeditor.js') }}"></script>

<!-- Main JS-->

<script src="{{ asset('admin/js/main.js') }}"></script>
<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('preview-image');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }

    function checkAll() {
        var checkboxes = document.getElementsByName("list_check[]");
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = true;
        }
    }
</script>

<script>
    $('.check-all').click(function() {
        $(this).closest('.card').find('.permission').prop('checked', this.checked)
    })
</script>
<script>
    CKEDITOR.replace('ckeditorProduct',{
        filebrowserImageUploadUrl : "{{ url('admin/product/upload-ckeditor?_token='.csrf_token()) }}",
        filebrowserBrowseUrl : "{{ url('admin/product/upload-browser?_token='.csrf_token()) }}",
        filebrowserUploadMethod : 'form',
    });
    CKEDITOR.replace('ckeditorBlog',{
        filebrowserImageUploadUrl : "{{ url('admin/blog/upload-ckeditor?_token='.csrf_token()) }}",
        filebrowserBrowseUrl : "{{ url('admin/blog/upload-browser?_token='.csrf_token()) }}",
        filebrowserUploadMethod : 'form',
    });
</script>
<script>
    const inputElement = document.querySelector('#detailImages');
    const previewElement = document.querySelector('#preview');

    inputElement.addEventListener('change', (event) => {
        const files = event.target.files;

        for (let i = 0; i < files.length; i++) {
            const reader = new FileReader();

            reader.onload = (event) => {
                const image = document.createElement('img');
                image.classList.add('preview-image');
                image.src = event.target.result;

                previewElement.appendChild(image);
            };

            reader.readAsDataURL(files[i]);
        }
    });
</script>
</body>

</html>
<!-- end document-->
