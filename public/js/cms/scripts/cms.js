var appCms = function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.fn.modal.Constructor.prototype._enforceFocus = function() {};

    function loadImage(input){
        if(input.files && input.files[0]){
            var reader = new FileReader();

            reader.onload = function(e){
                $('.banner').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    };

    $(document).on('change', '[name="image"]', function(){
        loadImage(this);
    });

    $(document).on('click', '#upload', function(){
        $('[name="image"]').trigger('click');
    });

    function loadThumbnail(input){
        if(input.files && input.files[0]){
            var reader = new FileReader();

            reader.onload = function(e){
                $('.banner1').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    };

    $(document).on('change', '[name="thumbnail"]', function(){
        loadThumbnail(this);
    });

    $(document).on('click', '#upload1', function(){
        $('[name="thumbnail"]').trigger('click');
    });

    var loadtableData = function(){

        var url = $('.tableData').data('url');

        $('.tableData').dataTable({

            processing: false,
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']],
            columnDefs: [{orderable: false, targets: -1}],
            serverSide: false,
            pagingType: 'full_numbers',
            lengthChange: true,
            info: true,
            language: {
                search: 'Search <i class="fas fa-search"></i> ',
                paginate: {
                    next: '<i class="fas fa-angle-right""></i>',
                    last: '<i class="fas fa-angle-double-right""></i>',
                    first: '<i class="fas fa-angle-double-left""></i>',
                    previous: '<i class="fas fa-angle-left""></i>'
                }
            },
            order: [],
            ajax: base_url + '/api/'+ url + '/get',
            autoWidth: false,
            destroy: true

        });

    };

    var loadcategoriestableData = function(){

        var url = $('.tableData').data('url');
        var type = $('.tableData').data('type');

        $('.tableData').dataTable({

            processing: false,
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']],
            columnDefs: [{orderable: false, targets: -1}],
            serverSide: false,
            pagingType: 'full_numbers',
            lengthChange: true,
            info: true,
            language: {
                search: 'Search <i class="fas fa-search"></i> ',
                paginate: {
                    next: '<i class="fas fa-angle-right""></i>',
                    last: '<i class="fas fa-angle-double-right""></i>',
                    first: '<i class="fas fa-angle-double-left""></i>',
                    previous: '<i class="fas fa-angle-left""></i>'
                }
            },
            order: [],
            ajax: base_url + '/api/'+ url + '/get?type=' + type,
            autoWidth: false,
            destroy: true

        });

    };

    var loadratestableData = function(){

        var url = $('.tableRatesData').data('url');
        var id = $('.tableRatesData').data('id');

        $('.tableRatesData').dataTable({

            processing: false,
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']],
            columnDefs: [{orderable: false, targets: -1}],
            serverSide: false,
            pagingType: 'full_numbers',
            lengthChange: true,
            info: true,
            language: {
                search: 'Search <i class="fas fa-search"></i> ',
                paginate: {
                    next: '<i class="fas fa-angle-right""></i>',
                    last: '<i class="fas fa-angle-double-right""></i>',
                    first: '<i class="fas fa-angle-double-left""></i>',
                    previous: '<i class="fas fa-angle-left""></i>'
                }
            },
            order: [],
            ajax: base_url + '/api/'+ url + '/get?id=' + id,
            autoWidth: false,
            destroy: true

        });

    };

    var forEdit = function(){
        $(document).on('click', '.editData', function(){
            var item = $(this).attr('id').split('-');

            $('#addRate').modal('show');

            if(item[0] == 'rates'){

                $.ajax({
                    type: 'GET',
                    url: base_url + '/api/rates/search',
                    data: {"item": item[1]},
                    dataType: 'json',
                    cache: false,

                    beforeSend : function() {
                    },
                    complete : function() {
                    },
                    success : function(data){

                        $('[name="id"]').val(data.rates.id);
                        $('[name="rate_type"]').val(data.rates.type).trigger('change');
                        $('[name="room_type"]').val(data.rates.room_id).trigger('change');
                        $('[name="12_hours_rate"]').val(data.rates.hours_12);
                        $('[name="24_hours_rate"]').val(data.rates.hours_24);
                        $('[name="status"]').val(data.rates.status_id).trigger('change');

                    },
                    error : function(){
                        swal("Failed", "Unable to connect to server.", "error");
                    }

                });

            }

        });
    };

    var forDelete = function(){
        $(document).on('click', '.delData', function(){
            var item = $(this).attr('id').split('-');

            if(item[0] == 'user'){

                swal({

                    title: "Are you sure?",
                    text: "Do you want to remove this data?",
                    type: 'warning',
                    showCancelButton: true,

                }).then((result) => {

                    if(result.value){

                        $.ajax({
                            type: 'POST',
                            url: base_url + '/api/accounts/delete',
                            data: {"item": item[1]},
                            dataType: 'json',
                            cache: false,

                            beforeSend : function(){
                                loading.open();
                            },
                            complete : function(){
                                loading.close();
                            },
                            success : function(data) {

                                if(data.status){

                                    swal("Success", data.message, "success").then(function(){
                                        loadtableData();
                                    });
                                    
                                }else{
                                    swal("Failed", "Can't delete this data.", "error");
                                }
                            },
                            error : function() {
                                swal("Failed", "Unable to connect to server.", "error");
                            }              
                            
                        });

                    }

                });

            }else if(item[0] == 'slider'){

                swal({

                    title: "Are you sure?",
                    text: "Do you want to remove this image?",
                    type: 'warning',
                    showCancelButton: true,

                }).then((result) => {

                    if(result.value){

                        $.ajax({
                            type: 'POST',
                            url: base_url + '/api/slider/delete',
                            data: {"item": item[1]},
                            dataType: 'json',
                            cache: false,

                            beforeSend : function(){
                                loading.open();
                            },
                            complete : function(){
                                loading.close();
                            },
                            success : function(data) {

                                if(data.status){

                                    swal("Success", data.message, "success").then(function(){
                                        loadtableData();
                                    });
                                    
                                }else{
                                    swal("Failed", "Can't delete this data.", "error");
                                }
                            },
                            error : function() {
                                swal("Failed", "Unable to connect to server.", "error");
                            }              
                            
                        });

                    }

                });

            }else if(item[0] == 'about'){

                swal({

                    title: "Are you sure?",
                    text: "Do you want to remove this data?",
                    type: 'warning',
                    showCancelButton: true,

                }).then((result) => {

                    if(result.value){

                        $.ajax({
                            type: 'POST',
                            url: base_url + '/api/about-us/delete',
                            data: {"item": item[1]},
                            dataType: 'json',
                            cache: false,

                            beforeSend : function(){
                                loading.open();
                            },
                            complete : function(){
                                loading.close();
                            },
                            success : function(data) {

                                if(data.status){

                                    swal("Success", data.message, "success").then(function(){
                                        loadtableData();
                                    });
                                    
                                }else{
                                    swal("Failed", "Can't delete this data.", "error");
                                }
                            },
                            error : function() {
                                swal("Failed", "Unable to connect to server.", "error");
                            }              
                            
                        });

                    }

                });

            }else if(item[0] == 'foods'){

                swal({

                    title: "Are you sure?",
                    text: "Do you want to remove this data?",
                    type: 'warning',
                    showCancelButton: true,

                }).then((result) => {

                    if(result.value){

                        $.ajax({
                            type: 'POST',
                            url: base_url + '/api/food-beverages/delete',
                            data: {"item": item[1]},
                            dataType: 'json',
                            cache: false,

                            beforeSend : function(){
                                loading.open();
                            },
                            complete : function(){
                                loading.close();
                            },
                            success : function(data) {

                                if(data.status){

                                    swal("Success", data.message, "success").then(function(){
                                        loadtableData();
                                    });
                                    
                                }else{
                                    swal("Failed", "Can't delete this data.", "error");
                                }
                            },
                            error : function() {
                                swal("Failed", "Unable to connect to server.", "error");
                            }              
                            
                        });

                    }

                });

            }else if(item[0] == 'promos'){

                swal({

                    title: "Are you sure?",
                    text: "Do you want to remove this data?",
                    type: 'warning',
                    showCancelButton: true,

                }).then((result) => {

                    if(result.value){

                        $.ajax({
                            type: 'POST',
                            url: base_url + '/api/promos/delete',
                            data: {"item": item[1]},
                            dataType: 'json',
                            cache: false,

                            beforeSend : function(){
                                loading.open();
                            },
                            complete : function(){
                                loading.close();
                            },
                            success : function(data) {

                                if(data.status){

                                    swal("Success", data.message, "success").then(function(){
                                        loadtableData();
                                    });
                                    
                                }else{
                                    swal("Failed", "Can't delete this data.", "error");
                                }
                            },
                            error : function() {
                                swal("Failed", "Unable to connect to server.", "error");
                            }              
                            
                        });

                    }

                });

            }else if(item[0] == 'events'){

                swal({

                    title: "Are you sure?",
                    text: "Do you want to remove this data?",
                    type: 'warning',
                    showCancelButton: true,

                }).then((result) => {

                    if(result.value){

                        $.ajax({
                            type: 'POST',
                            url: base_url + '/api/events/delete',
                            data: {"item": item[1]},
                            dataType: 'json',
                            cache: false,

                            beforeSend : function(){
                                loading.open();
                            },
                            complete : function(){
                                loading.close();
                            },
                            success : function(data) {

                                if(data.status){

                                    swal("Success", data.message, "success").then(function(){
                                        loadtableData();
                                    });
                                    
                                }else{
                                    swal("Failed", "Can't delete this data.", "error");
                                }
                            },
                            error : function() {
                                swal("Failed", "Unable to connect to server.", "error");
                            }              
                            
                        });

                    }

                });

            }else if(item[0] == 'careers'){

                swal({

                    title: "Are you sure?",
                    text: "Do you want to remove this data?",
                    type: 'warning',
                    showCancelButton: true,

                }).then((result) => {

                    if(result.value){

                        $.ajax({
                            type: 'POST',
                            url: base_url + '/api/careers/delete',
                            data: {"item": item[1]},
                            dataType: 'json',
                            cache: false,

                            beforeSend : function(){
                                loading.open();
                            },
                            complete : function(){
                                loading.close();
                            },
                            success : function(data) {

                                if(data.status){

                                    swal("Success", data.message, "success").then(function(){
                                        loadtableData();
                                    });
                                    
                                }else{
                                    swal("Failed", "Can't delete this data.", "error");
                                }
                            },
                            error : function() {
                                swal("Failed", "Unable to connect to server.", "error");
                            }              
                            
                        });

                    }

                });

            }else if(item[0] == 'photos'){

                swal({

                    title: "Are you sure?",
                    text: "Do you want to remove this data?",
                    type: 'warning',
                    showCancelButton: true,

                }).then((result) => {

                    if(result.value){

                        $.ajax({
                            type: 'POST',
                            url: base_url + '/api/photos/delete',
                            data: {"item": item[1]},
                            dataType: 'json',
                            cache: false,

                            beforeSend : function(){
                                loading.open();
                            },
                            complete : function(){
                                loading.close();
                            },
                            success : function(data) {

                                if(data.status){

                                    swal("Success", data.message, "success").then(function(){
                                        loadtableData();
                                    });
                                    
                                }else{
                                    swal("Failed", "Can't delete this data.", "error");
                                }
                            },
                            error : function() {
                                swal("Failed", "Unable to connect to server.", "error");
                            }              
                            
                        });

                    }

                });

            }else if(item[0] == 'rooms'){

                swal({

                    title: "Are you sure?",
                    text: "Do you want to remove this data?",
                    type: 'warning',
                    showCancelButton: true,

                }).then((result) => {

                    if(result.value){

                        $.ajax({
                            type: 'POST',
                            url: base_url + '/api/rooms/delete',
                            data: {"item": item[1]},
                            dataType: 'json',
                            cache: false,

                            beforeSend : function(){
                                loading.open();
                            },
                            complete : function(){
                                loading.close();
                            },
                            success : function(data) {

                                if(data.status){

                                    swal("Success", data.message, "success").then(function(){
                                        loadtableData();
                                    });
                                    
                                }else{
                                    swal("Failed", "Can't delete this data.", "error");
                                }
                            },
                            error : function() {
                                swal("Failed", "Unable to connect to server.", "error");
                            }              
                            
                        });

                    }

                });

            }else if(item[0] == 'category'){

                swal({

                    title: "Are you sure?",
                    text: "Do you want to remove this data?",
                    type: 'warning',
                    showCancelButton: true,

                }).then((result) => {

                    if(result.value){

                        $.ajax({
                            type: 'POST',
                            url: base_url + '/api/category/delete',
                            data: {"item": item[1]},
                            dataType: 'json',
                            cache: false,

                            beforeSend : function(){
                                loading.open();
                            },
                            complete : function(){
                                loading.close();
                            },
                            success : function(data) {

                                if(data.status){

                                    swal("Success", data.message, "success").then(function(){
                                        loadcategoriestableData();
                                    });
                                    
                                }else{
                                    swal("Failed", "Can't delete this data.", "error");
                                }
                            },
                            error : function() {
                                swal("Failed", "Unable to connect to server.", "error");
                            }              
                            
                        });

                    }

                });

            }else if(item[0] == 'branch'){

                swal({

                    title: "Are you sure?",
                    text: "Do you want to remove this data?",
                    type: 'warning',
                    showCancelButton: true,

                }).then((result) => {

                    if(result.value){

                        $.ajax({
                            type: 'POST',
                            url: base_url + '/api/branches/delete',
                            data: {"item": item[1]},
                            dataType: 'json',
                            cache: false,

                            beforeSend : function(){
                                loading.open();
                            },
                            complete : function(){
                                loading.close();
                            },
                            success : function(data) {

                                if(data.status){

                                    swal("Success", data.message, "success").then(function(){
                                        loadtableData();
                                    });
                                    
                                }else{
                                    swal("Failed", "Can't delete this data.", "error");
                                }
                            },
                            error : function() {
                                swal("Failed", "Unable to connect to server.", "error");
                            }              
                            
                        });

                    }

                });

            }else if(item[0] == 'rates'){

                swal({

                    title: "Are you sure?",
                    text: "Do you want to remove this data?",
                    type: 'warning',
                    showCancelButton: true,

                }).then((result) => {

                    if(result.value){

                        $.ajax({
                            type: 'POST',
                            url: base_url + '/api/rates/delete',
                            data: {"item": item[1]},
                            dataType: 'json',
                            cache: false,

                            beforeSend : function(){
                                loading.open();
                            },
                            complete : function(){
                                loading.close();
                            },
                            success : function(data) {

                                if(data.status){

                                    swal("Success", data.message, "success").then(function(){
                                        loadratestableData();
                                    });
                                    
                                }else{
                                    swal("Failed", "Can't delete this data.", "error");
                                }
                            },
                            error : function() {
                                swal("Failed", "Unable to connect to server.", "error");
                            }              
                            
                        });

                    }

                });

            }else if(item[0] == 'social'){

                swal({

                    title: "Are you sure?",
                    text: "Do you want to remove this data?",
                    type: 'warning',
                    showCancelButton: true,

                }).then((result) => {

                    if(result.value){

                        $.ajax({
                            type: 'POST',
                            url: base_url + '/api/social-media/delete',
                            data: {"item": item[1]},
                            dataType: 'json',
                            cache: false,

                            beforeSend : function(){
                                loading.open();
                            },
                            complete : function(){
                                loading.close();
                            },
                            success : function(data) {

                                if(data.status){

                                    swal("Success", data.message, "success").then(function(){
                                        loadtableData();
                                    });
                                    
                                }else{
                                    swal("Failed", "Can't delete this data.", "error");
                                }
                            },
                            error : function() {
                                swal("Failed", "Unable to connect to server.", "error");
                            }              
                            
                        });

                    }

                });

            }

        });

    };

    var foruser = function(){

        $(document).on('submit', '#frmAddAccount', function(e){
        e.preventDefault();

            $.ajax({
                type: 'POST',
                url: base_url + '/api/accounts/save',
                data: $('#frmAddAccount').serialize(),
                dataType: 'json',
                cache: false,

                beforeSend : function(){
                    loading.open();
                    $('.btnSave').attr('disabled', true);
                },
                complete : function(){
                    loading.close();
                    $('.btnSave').attr('disabled', false);
                },
                success : function(data){

                    if(data.status){

                        swal("Success", data.message, "success").then(function(){
                            window.location.href = base_url +  '/cms/user-manager';
                        });

                    }else{

                        var html = '';
                        html += '<ul class="list-unstyled">';
                        $(data.message).each(function(a, b){
                            html += '<li class="text-danger">'+ b +'</li>';
                        });
                        html += '</ul>';

                        swal("Error", html, "error");
                    }

                },
                error : function(){
                    swal("Failed", "Unable to connect to server.", "error");
                }

            });

            return false;
        });

        $(document).on('submit', '#frmUpdateAccount', function(e){
        e.preventDefault();

            $.ajax({
                type: 'POST',
                url: base_url + '/api/accounts/update',
                data: $('#frmUpdateAccount').serialize(),
                dataType: 'json',
                cache: false,

                beforeSend : function(){
                    loading.open();
                    $('.btnSave').attr('disabled', true);
                },
                complete : function(){
                    loading.close();
                    $('.btnSave').attr('disabled', false);
                },
                success : function(data){

                    if(data.status){

                        swal("Success", data.message, "success").then(function(){
                            window.location.reload(true);
                        });

                    }else{

                        var html = '';
                        html += '<ul class="list-unstyled">';
                        $(data.message).each(function(a, b){
                            html += '<li class="text-danger">'+ b +'</li>';
                        });
                        html += '</ul>';

                        swal("Error", html, "error");
                    }

                },
                error : function(){
                    swal("Failed", "Unable to connect to server.", "error");
                }

            });

            return false;
        });

    };

    var forpagemanager = function(){

        $(document).on('submit', '#frmAddPage', function(e){
        e.preventDefault();

            var formData = new FormData($(this)[0]);

            $.ajax({
                type: 'POST',
                url: base_url + '/api/page-manager/save',
                data: formData,
                dataType: 'json',
                cache: false,
                cache: false,
                contentType: false,
                processData: false,

                beforeSend : function(){
                    loading.open();
                    $('.btnSave').attr('disabled', true);
                },
                complete : function(){
                    loading.close();
                    $('.btnSave').attr('disabled', false);
                },
                success : function(data){

                    if(data.status){

                        swal("Success", data.message, "success").then(function(){
                            window.location.href = base_url +  '/cms/page-manager';
                        });

                    }else{

                        var html = '';
                        html += '<ul class="list-unstyled">';
                        $(data.message).each(function(a, b){
                            html += '<li class="text-danger">'+ b +'</li>';
                        });
                        html += '</ul>';

                        swal("Error", html, "error");
                    }

                },
                error : function(){
                    swal("Failed", "Unable to connect to server.", "error");
                }

            });

            return false;
        });

    };

    var forslider = function(){

        $(document).on('submit', '#frmAddSlider', function(e){
        e.preventDefault();

            var formData = new FormData($(this)[0]);

            $.ajax({
                type: 'POST',
                url: base_url + '/api/slider/save',
                data: formData,
                dataType: 'json',
                cache: false,
                cache: false,
                contentType: false,
                processData: false,

                beforeSend : function(){
                    loading.open();
                    $('.btnSave').attr('disabled', true);
                },
                complete : function(){
                    loading.close();
                    $('.btnSave').attr('disabled', false);
                },
                success : function(data){

                    if(data.status){

                        swal("Success", data.message, "success").then(function(){
                            window.location.href = base_url +  '/cms/maintenance/homepage-banner';
                        });

                    }else{

                        var html = '';
                        html += '<ul class="list-unstyled">';
                        $(data.message).each(function(a, b){
                            html += '<li class="text-danger">'+ b +'</li>';
                        });
                        html += '</ul>';

                        swal("Error", html, "error");
                    }

                },
                error : function(){
                    swal("Failed", "Unable to connect to server.", "error");
                }

            });

            return false;
        });

    };

    var forabout = function(){

        $(document).on('submit', '#frmAddAboutUs', function(e){
        e.preventDefault();

            var formData = new FormData($(this)[0]);

            $.ajax({
                type: 'POST',
                url: base_url + '/api/about-us/save',
                data: formData,
                dataType: 'json',
                cache: false,
                cache: false,
                contentType: false,
                processData: false,

                beforeSend : function(){
                    loading.open();
                    $('.btnSave').attr('disabled', true);
                },
                complete : function(){
                    loading.close();
                    $('.btnSave').attr('disabled', false);
                },
                success : function(data){

                    if(data.status){

                        swal("Success", data.message, "success").then(function(){
                            window.location.href = base_url +  '/cms/maintenance/about-us';
                        });

                    }else{

                        var html = '';
                        html += '<ul class="list-unstyled">';
                        $(data.message).each(function(a, b){
                            html += '<li class="text-danger">'+ b +'</li>';
                        });
                        html += '</ul>';

                        swal("Error", html, "error");
                    }

                },
                error : function(){
                    swal("Failed", "Unable to connect to server.", "error");
                }

            });

            return false;
        });

    };

    var forfoods = function(){

        $(document).on('submit', '#frmAddFoodBeverages', function(e){
        e.preventDefault();

            var formData = new FormData($(this)[0]);

            $.ajax({
                type: 'POST',
                url: base_url + '/api/food-beverages/save',
                data: formData,
                dataType: 'json',
                cache: false,
                cache: false,
                contentType: false,
                processData: false,

                beforeSend : function(){
                    loading.open();
                    $('.btnSave').attr('disabled', true);
                },
                complete : function(){
                    loading.close();
                    $('.btnSave').attr('disabled', false);
                },
                success : function(data){

                    if(data.status){

                        swal("Success", data.message, "success").then(function(){
                            window.location.href = base_url +  '/cms/maintenance/food-beverages';
                        });

                    }else{

                        var html = '';
                        html += '<ul class="list-unstyled">';
                        $(data.message).each(function(a, b){
                            html += '<li class="text-danger">'+ b +'</li>';
                        });
                        html += '</ul>';

                        swal("Error", html, "error");
                    }

                },
                error : function(){
                    swal("Failed", "Unable to connect to server.", "error");
                }

            });

            return false;
        });

    };

    var forpromos = function(){

        $(document).on('submit', '#frmAddPromos', function(e){
        e.preventDefault();

            var formData = new FormData($(this)[0]);

            $.ajax({
                type: 'POST',
                url: base_url + '/api/promos/save',
                data: formData,
                dataType: 'json',
                cache: false,
                cache: false,
                contentType: false,
                processData: false,

                beforeSend : function(){
                    loading.open();
                    $('.btnSave').attr('disabled', true);
                },
                complete : function(){
                    loading.close();
                    $('.btnSave').attr('disabled', false);
                },
                success : function(data){

                    if(data.status){

                        swal("Success", data.message, "success").then(function(){
                            window.location.href = base_url +  '/cms/maintenance/promos';
                        });

                    }else{

                        var html = '';
                        html += '<ul class="list-unstyled">';
                        $(data.message).each(function(a, b){
                            html += '<li class="text-danger">'+ b +'</li>';
                        });
                        html += '</ul>';

                        swal("Error", html, "error");
                    }

                },
                error : function(){
                    swal("Failed", "Unable to connect to server.", "error");
                }

            });

            return false;
        });

    };

    var forevents = function(){

        $(document).on('submit', '#frmAddEvents', function(e){
        e.preventDefault();

            var formData = new FormData($(this)[0]);

            $.ajax({
                type: 'POST',
                url: base_url + '/api/events/save',
                data: formData,
                dataType: 'json',
                cache: false,
                cache: false,
                contentType: false,
                processData: false,

                beforeSend : function(){
                    loading.open();
                    $('.btnSave').attr('disabled', true);
                },
                complete : function(){
                    loading.close();
                    $('.btnSave').attr('disabled', false);
                },
                success : function(data){

                    if(data.status){

                        swal("Success", data.message, "success").then(function(){
                            window.location.href = base_url +  '/cms/maintenance/events';
                        });

                    }else{

                        var html = '';
                        html += '<ul class="list-unstyled">';
                        $(data.message).each(function(a, b){
                            html += '<li class="text-danger">'+ b +'</li>';
                        });
                        html += '</ul>';

                        swal("Error", html, "error");
                    }

                },
                error : function(){
                    swal("Failed", "Unable to connect to server.", "error");
                }

            });

            return false;
        });

    };

    var forcareers = function(){

        $(document).on('submit', '#frmAddCareers', function(e){
        e.preventDefault();

            $.ajax({
                type: 'POST',
                url: base_url + '/api/careers/save',
                data: $('#frmAddCareers').serialize(),
                dataType: 'json',
                cache: false,

                beforeSend : function(){
                    loading.open();
                    $('.btnSave').attr('disabled', true);
                },
                complete : function(){
                    loading.close();
                    $('.btnSave').attr('disabled', false);
                },
                success : function(data){

                    if(data.status){

                        swal("Success", data.message, "success").then(function(){
                            window.location.href = base_url +  '/cms/maintenance/careers';
                        });

                    }else{

                        var html = '';
                        html += '<ul class="list-unstyled">';
                        $(data.message).each(function(a, b){
                            html += '<li class="text-danger">'+ b +'</li>';
                        });
                        html += '</ul>';

                        swal("Error", html, "error");
                    }

                },
                error : function(){
                    swal("Failed", "Unable to connect to server.", "error");
                }

            });

            return false;
        });

    };

    var forphotos = function(){

        $(document).on('submit', '#frmAddPhotos', function(e){
        e.preventDefault();

            var formData = new FormData($(this)[0]);

            $.ajax({
                type: 'POST',
                url: base_url + '/api/photos/save',
                data: formData,
                dataType: 'json',
                cache: false,
                cache: false,
                contentType: false,
                processData: false,

                beforeSend : function(){
                    loading.open();
                    $('.btnSave').attr('disabled', true);
                },
                complete : function(){
                    loading.close();
                    $('.btnSave').attr('disabled', false);
                },
                success : function(data){

                    if(data.status){

                        swal("Success", data.message, "success").then(function(){
                            window.location.href = base_url +  '/cms/maintenance/photos';
                        });

                    }else{

                        var html = '';
                        html += '<ul class="list-unstyled">';
                        $(data.message).each(function(a, b){
                            html += '<li class="text-danger">'+ b +'</li>';
                        });
                        html += '</ul>';

                        swal("Error", html, "error");
                    }

                },
                error : function(){
                    swal("Failed", "Unable to connect to server.", "error");
                }

            });

            return false;
        });

    };

    var forcategory = function(){

        $(document).on('submit', '#frmAddCategory', function(e){
        e.preventDefault();

            var formData = new FormData($(this)[0]);

            $.ajax({
                type: 'POST',
                url: base_url + '/api/category/save',
                data: formData,
                dataType: 'json',
                cache: false,
                cache: false,
                contentType: false,
                processData: false,

                beforeSend : function(){
                    loading.open();
                    $('.btnSave').attr('disabled', true);
                },
                complete : function(){
                    loading.close();
                    $('.btnSave').attr('disabled', false);
                },
                success : function(data){

                    if(data.status){

                        swal("Success", data.message, "success").then(function(){
                            window.location.href = base_url +  '/cms/category/' + data.type;
                        });

                    }else{

                        var html = '';
                        html += '<ul class="list-unstyled">';
                        $(data.message).each(function(a, b){
                            html += '<li class="text-danger">'+ b +'</li>';
                        });
                        html += '</ul>';

                        swal("Error", html, "error");
                    }

                },
                error : function(){
                    swal("Failed", "Unable to connect to server.", "error");
                }

            });

            return false;
        });

    };

    var forbranches = function(){

        $(document).on('submit', '#frmAddBranches', function(e){
        e.preventDefault();

            $.ajax({
                type: 'POST',
                url: base_url + '/api/branches/save',
                data: $('#frmAddBranches').serialize(),
                dataType: 'json',
                cache: false,

                beforeSend : function(){
                    loading.open();
                    $('.btnSave').attr('disabled', true);
                },
                complete : function(){
                    loading.close();
                    $('.btnSave').attr('disabled', false);
                },
                success : function(data){

                    if(data.status){

                        swal("Success", data.message, "success").then(function(){
                            if(data.type == 'save'){
                                window.location.href = base_url +  '/cms/branch-manager/edit/' + data.bid;
                            }else{
                                window.location.href = base_url +  '/cms/branch-manager';
                            }
                        });

                    }else{

                        var html = '';
                        html += '<ul class="list-unstyled">';
                        $(data.message).each(function(a, b){
                            html += '<li class="text-danger">'+ b +'</li>';
                        });
                        html += '</ul>';

                        swal("Error", html, "error");
                    }

                },
                error : function(){
                    swal("Failed", "Unable to connect to server.", "error");
                }

            });

            return false;
        });

    };

    var forsocailmedia = function(){

        $(document).on('submit', '#frmAddASocialMedia', function(e){
        e.preventDefault();

            $.ajax({
                type: 'POST',
                url: base_url + '/api/social-media/save',
                data: $('#frmAddASocialMedia').serialize(),
                dataType: 'json',
                cache: false,

                beforeSend : function(){
                    loading.open();
                    $('.btnSave').attr('disabled', true);
                },
                complete : function(){
                    loading.close();
                    $('.btnSave').attr('disabled', false);
                },
                success : function(data){

                    if(data.status){

                        swal("Success", data.message, "success").then(function(){
                            window.location.href = base_url +  '/cms/social-media-management';
                        });

                    }else{

                        var html = '';
                        html += '<ul class="list-unstyled">';
                        $(data.message).each(function(a, b){
                            html += '<li class="text-danger">'+ b +'</li>';
                        });
                        html += '</ul>';

                        swal("Error", html, "error");
                    }

                },
                error : function(){
                    swal("Failed", "Unable to connect to server.", "error");
                }

            });

            return false;
        });

    };

    var forrates = function(){

        $(document).on('submit', '#frmAddRates', function(e){
        e.preventDefault();

            $.ajax({
                type: 'POST',
                url: base_url + '/api/rates/save',
                data: $('#frmAddRates').serialize(),
                dataType: 'json',
                cache: false,

                beforeSend : function(){
                    loading.open();
                    $('.btnSave').attr('disabled', true);
                },
                complete : function(){
                    loading.close();
                    $('.btnSave').attr('disabled', false);
                },
                success : function(data){

                    if(data.status){

                        $('.ajax-response').show();
                        $('.ajax-message').html(data.message);

                        $('[name="id"]').val("");
                        $('[name="rate_type"]').val("").trigger('change');
                        $('[name="room_type"]').val("").trigger('change');
                        $('[name="12_hours_rate"]').val("");
                        $('[name="24_hours_rate"]').val("");
                        $('[name="status"]').val("1").trigger('change');

                        loadratestableData();

                        setTimeout(function(){
                            $('.ajax-response').fadeOut();
                            $('#addRate').modal('hide');
                        },2000);

                    }else{

                        var html = '<div class="alert alert-danger">';
                        html += '<ul class="list-unstyled">';
                        $(data.message).each(function(a, b){
                            html += '<li class="text-danger">'+ b +'</li>';
                        });
                        html += '</ul>\
                            </div>';

                        $('.ajax-response').show();
                        $('.ajax-message').html(html);

                        setTimeout(function(){
                            $('.ajax-response').fadeOut();
                        },5000);

                    }

                },
                error : function(){
                    alert("Unable to connect to server.");
                }

            });

            return false;
        });

    };

    var forsettings = function(){

        $(document).on('submit', '#frmSettings', function(e){
        e.preventDefault();

            $.ajax({
                type: 'POST',
                url: base_url + '/api/settings/save',
                data: $('#frmSettings').serialize(),
                dataType: 'json',
                cache: false,

                beforeSend : function(){
                    loading.open();
                    $('.btnSave').attr('disabled', true);
                },
                complete : function(){
                    loading.close();
                    $('.btnSave').attr('disabled', false);
                },
                success : function(data){

                    if(data.status){

                        swal("Success", data.message, "success").then(function(){
                            window.location.reload(true);
                        });

                    }else{

                        var html = '';
                        html += '<ul class="list-unstyled">';
                        $(data.message).each(function(a, b){
                            html += '<li class="text-danger">'+ b +'</li>';
                        });
                        html += '</ul>';

                        swal("Error", html, "error");
                    }

                },
                error : function(){
                    swal("Failed", "Unable to connect to server.", "error");
                }

            });

            return false;
        });

    };

    var filtercity = function(){

        $(document).on('change', '[name="branch_province"]', function(e){
            item = $(this).val();

            $.ajax({
                type: 'GET',
                url: base_url + '/api/filter/city',
                data: {"item": item},
                dataType: 'json',
                cache: false,

                success : function(data){

                    var html = '<option></option>';

                    $(data.city).each(function(a, b){

                        html += '<option value="'+ b.id +'">'+ b.city +'</option>'

                    });

                    $('[name="branch_city"]').html(html);

                },
                error : function(){
                    swal("Failed", "Unable to connect to server.", "error");
                }

            });

        });

    };

    var forinquiry = function(){

        $(document).on('click', '.viewData', function(){
            var item = $(this).attr('id').split('-');

            $('#viewInquiry').modal('show');

            $.ajax({
                type: 'GET',
                url: base_url + '/api/inquiry/search',
                data: {"item": item[1]},
                dataType: 'json',
                cache: false,

                beforeSend : function() {
                    $('.modal-title').html("Loading...");
                    $('.modal-body').html("");
                },
                complete : function() {
                },
                success : function(data){

                    $('.modal-title').html(data.inquiry.name);

                    var html = '';
                    html += '<div class="mb-2">\
                            <strong>'+ data.inquiry.email +'</strong>\
                        </div>\
                        <div class="mb-2">\
                            <strong>Type: </strong>\
                            <p class="m-0">'+ data.inquiry.type +'</p>\
                        </div>\
                        <div class="mb-2">\
                            <strong>Number: </strong>\
                            <p class="m-0">'+ data.inquiry.number +'</p>\
                        </div>\
                        <div class="mb-2">\
                            <strong>Message: </strong>\
                            <p class="m-0">'+ data.inquiry.message +'</p>\
                        </div>';

                    $('.modal-body').html(html);

                },
                error : function(){
                    swal("Failed", "Unable to connect to server.", "error");
                }

            });

        });

    };

    var forlogs = function(){

        $(document).on('click', '.viewData', function(){
            var item = $(this).attr('id').split('-');

            $('#viewLogs').modal('show');

            $.ajax({
                type: 'GET',
                url: base_url + '/api/logs/search',
                data: {"item": item[1]},
                dataType: 'html',
                cache: false,

                beforeSend : function() {
                    $('.modal-body').html("");
                },
                complete : function() {
                },
                success : function(data){

                    $('.modal-body').html(data);

                },
                error : function(){
                    swal("Failed", "Unable to connect to server.", "error");
                }

            });

        });

    };

    return {
        init : function(){
            forDelete();
        },
        initAccountData : function(){
            foruser();
            loadtableData();
        },
        initPageManagerData : function(){
            forpagemanager();
            loadtableData();
        },
        initSliderData : function(){
            forslider();
            loadtableData();
        },
        initAboutUsData : function(){
            forabout();
            loadtableData();
        },
        initFoodBeveragesData : function(){
            forfoods();
            loadtableData();
        },
        initPromosData : function(){
            forpromos();
            loadtableData();
        },
        initEventsData : function(){
            forevents();
            loadtableData();
        },
        initCareersData : function(){
            forcareers();
            loadtableData();
        },
        initPhotosData : function(){
            forphotos();
            loadtableData();
        },
        initRoomsData : function(){
            forrooms();
            loadtableData();
        },
        initCategoryData : function(){
            loadcategoriestableData();
            forcategory();
        },
        initBranchesData : function(){
            filtercity();
            forbranches();
            loadtableData();
        },
        initRatesData : function(){
            forEdit();
            forrates();
            loadratestableData();
        },
        initSocialMediaData : function(){
            loadtableData();
            forsocailmedia();
        },
        initInquiryData : function(){
            loadtableData();
            forinquiry();
        },
        initLogsData : function(){
            loadtableData();
            forlogs();
        },
        initSettingsData : function(){
            forsettings();
        }
    };

}();
