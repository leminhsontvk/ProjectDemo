window.onload = function ()
{
    $('.product-img').not('.no-hover').hover
    (
        function ()
        {
            $('> #img2', this).fadeOut(500);
        },
        function ()
        {
            $('> #img2', this).fadeIn(500);
        }
    );

    $('#IsSale').change(function ()
    {
        $('#IsNotSale').prop( "checked", false);
    });

    $('#IsNotSale').change(function ()
    {
        $('#IsSale').prop( "checked", false);
    });

    $('.product-container').not('.product-container a#DoDeleteProduct').on('click', function ()
    {
        if (NotAdmin === true)
        {
            window.location.href = ('?QGPage=Product&Product=' + $(this).attr('qgid'));
        } else window.location.href = "?Admin=Product&Product=" + $(this).attr('qgid');
    });

    if ($('#Content').length > 0)
    {
        tinymce.activeEditor.setContent($('#Content')['0'].innerHTML);
    }
    $('#btn-category-image').on('click', function (Event)
    {
        Event.preventDefault();

        $('#input-category-image').trigger('click');
    });

    $('#btn-category-add-image').on('click', function (Event)
    {
        Event.preventDefault();

        $('#input-category-image').trigger('click');
    });

    jQuery('table.table tr').each(function ()
    {
        let Spinner = jQuery(this);

        let SubjectName = Spinner.find('#SubjectName').val();
        let SubjectID = Spinner.find('#SubjectID').val();
        let Delete = Spinner.find('#DeleteCategory');
        let Edit = Spinner.find('#EditCategory');
        let BlockUser = Spinner.find('#BlockUser');
        let UnblockUser = Spinner.find('#ActiveUser');
        let MakeSuperUser = Spinner.find('#MakeAdmin');
        let DeleteCoupon = Spinner.find('#DeleteCoupon');
        let EditCoupon = Spinner.find('#EditCoupon');
        let DeleteNews = Spinner.find('#DeleteNews');
        let DeleteBill = Spinner.find('#DeleteBill');
        let DeleteContact = Spinner.find('#DeleteContact');
        let DeleteBanner = Spinner.find('#DeleteBanner');
        let SetUnActive = Spinner.find('#SetUnactive');
        let SetActive = Spinner.find('#SetActive');

        let SetCancel = Spinner.find('#SetCancel');
        let SetShipping = Spinner.find('#SetShipping');
        let SetDelivered = Spinner.find('#SetDelivered');
        let SetDeliveryFail = Spinner.find('#SetDeliveryFail');

        async function DoChangeBillStatus (Status, ISubjectID)
        {
            let Loading = Swal.fire
            (
                {
                    allowEscapeKey: false,
                    title: 'Đang kiểm tra',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    text: 'Vui lòng chờ trong giây lát...',
                    imageUrl: '../Themes/Images/Default/Loading.gif',
                }
            );

            let DoEditStatus = new FormData();

            DoEditStatus.append('Status', Status);
            DoEditStatus.append('SubjectID', ISubjectID);
            DoEditStatus.append('Action', 'BillStatus');

            await $.ajax
            (
                {
                    type: 'POST',
                    url: 'QGarden/AJAX.php',
                    dataType: 'JSON',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: DoEditStatus,
                    success: function (Respond)
                    {
                        if (Respond.StatusCode === 1)
                        {
                            Loading.close();

                            Swal.fire
                            (
                                {
                                    timer: 3000,
                                    type: 'success',
                                    title: 'Thành Công',
                                    text: 'Thay Đổi Thành Công.',
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                }
                            );

                            window.location.reload();
                        }
                        else
                        {
                            Loading.close();

                            Swal.fire
                            (
                                {
                                    timer: 3000,
                                    type: 'error',
                                    title: 'Có lỗi xảy ra trong quá trình xử lý dữ liệu. Vui lòng thử lại sau.',
                                    showConfirmButton: true,
                                    showCancelButton: false,
                                }
                            );
                        }
                    },
                    error: function ()
                    {
                        Loading.close();

                        Swal.fire
                        (
                            {
                                timer: 3000,
                                type: 'error',
                                title: 'Oops',
                                text: 'Có lỗi xảy ra trong quá trình xử lý dữ liệu. Vui lòng thử lại sau.',
                                showConfirmButton: true,
                                showCancelButton: false,
                            }
                        );
                    }

                }
            );
        }

        async function DoChangeBannerStatus (Status, ISubjectID)
        {
            let Loading = Swal.fire
            (
                {
                    allowEscapeKey: false,
                    title: 'Đang kiểm tra',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    text: 'Vui lòng chờ trong giây lát...',
                    imageUrl: '../Themes/Images/Default/Loading.gif',
                }
            );

            let DoEditStatus = new FormData();

            DoEditStatus.append('Status', Status);
            DoEditStatus.append('SubjectID', ISubjectID);
            DoEditStatus.append('Action', 'BannerStatus');

            await $.ajax
            (
                {
                    type: 'POST',
                    url: 'QGarden/AJAX.php',
                    dataType: 'JSON',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: DoEditStatus,
                    success: function (Respond)
                    {
                        if (Respond.StatusCode === 1)
                        {
                            Loading.close();

                            Swal.fire
                            (
                                {
                                    timer: 3000,
                                    type: 'success',
                                    title: 'Thành Công',
                                    text: 'Thay Đổi Thành Công.',
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                }
                            );

                            window.location.reload();
                        }
                        else
                        {
                            Loading.close();

                            Swal.fire
                            (
                                {
                                    timer: 3000,
                                    type: 'error',
                                    title: 'Có lỗi xảy ra trong quá trình xử lý dữ liệu. Vui lòng thử lại sau.',
                                    showConfirmButton: true,
                                    showCancelButton: false,
                                }
                            );
                        }
                    },
                    error: function ()
                    {
                        Loading.close();

                        Swal.fire
                        (
                            {
                                timer: 3000,
                                type: 'error',
                                title: 'Oops',
                                text: 'Có lỗi xảy ra trong quá trình xử lý dữ liệu. Vui lòng thử lại sau.',
                                showConfirmButton: true,
                                showCancelButton: false,
                            }
                        );
                    }

                }
            );
        }

        SetUnActive.click(async function (Event)
        {
            Event.preventDefault();
            let ID = $(this).attr('value');
            DoChangeBannerStatus(0, ID);
        });

        SetActive.click(async function (Event)
        {
            Event.preventDefault();
            let ID = $(this).attr('value');
            DoChangeBannerStatus(1, ID);
        });

        DeleteBill.click(async function (Event)
        {
            Event.preventDefault();

            let Loading = Swal.fire
            (
                {
                    allowEscapeKey: false,
                    title: 'Đang kiểm tra',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    text: 'Vui lòng chờ trong giây lát...',
                    imageUrl: '../Themes/Images/Default/Loading.gif',
                }
            );

            let DoEditStatus = new FormData();

            DoEditStatus.append('SubjectID', $(this).attr('value'));
            DoEditStatus.append('Action', 'DeleteBill');

            await $.ajax
            (
                {
                    type: 'POST',
                    url: 'QGarden/AJAX.php',
                    dataType: 'JSON',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: DoEditStatus,
                    success: function (Respond)
                    {
                        if (Respond.StatusCode === 1)
                        {
                            Loading.close();

                            Swal.fire
                            (
                                {
                                    timer: 3000,
                                    type: 'success',
                                    title: 'Thành Công',
                                    text: 'Xóa Thành Công.',
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                }
                            );

                            window.location.reload();
                        }
                        else
                        {
                            Loading.close();

                            Swal.fire
                            (
                                {
                                    timer: 3000,
                                    type: 'error',
                                    title: 'Oops',
                                    text: 'Có lỗi xảy ra trong quá trình xử lý dữ liệu. Vui lòng thử lại sau.',
                                    showConfirmButton: true,
                                    showCancelButton: false,
                                }
                            );
                        }
                    },
                    error: function ()
                    {
                        Loading.close();

                        Swal.fire
                        (
                            {
                                timer: 3000,
                                type: 'error',
                                title: 'Có lỗi xảy ra trong quá trình xử lý dữ liệu. Vui lòng thử lại sau.',
                                showConfirmButton: true,
                                showCancelButton: false,
                            }
                        );
                    }

                }
            );
        });

        DeleteBanner.click(async function (Event)
        {
            Event.preventDefault();

            let Loading = Swal.fire
            (
                {
                    allowEscapeKey: false,
                    title: 'Đang kiểm tra',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    text: 'Vui lòng chờ trong giây lát...',
                    imageUrl: '../Themes/Images/Default/Loading.gif',
                }
            );

            let DoEditStatus = new FormData();

            DoEditStatus.append('SubjectID', $(this).attr('value'));
            DoEditStatus.append('Action', 'DeleteBanner');

            await $.ajax
            (
                {
                    type: 'POST',
                    url: 'QGarden/AJAX.php',
                    dataType: 'JSON',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: DoEditStatus,
                    success: function (Respond)
                    {
                        if (Respond.StatusCode === 1)
                        {
                            Loading.close();

                            Swal.fire
                            (
                                {
                                    timer: 3000,
                                    type: 'success',
                                    title: 'Thành Công',
                                    text: 'Xóa Thành Công.',
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                }
                            );

                            window.location.reload();
                        }
                        else
                        {
                            Loading.close();

                            Swal.fire
                            (
                                {
                                    timer: 3000,
                                    type: 'error',
                                    title: 'Oops',
                                    text: 'Có lỗi xảy ra trong quá trình xử lý dữ liệu. Vui lòng thử lại sau.',
                                    showConfirmButton: true,
                                    showCancelButton: false,
                                }
                            );
                        }
                    },
                    error: function ()
                    {
                        Loading.close();

                        Swal.fire
                        (
                            {
                                timer: 3000,
                                type: 'error',
                                title: 'Có lỗi xảy ra trong quá trình xử lý dữ liệu. Vui lòng thử lại sau.',
                                showConfirmButton: true,
                                showCancelButton: false,
                            }
                        );
                    }

                }
            );
        });

        DeleteContact.click(async function (Event)
        {
            Event.preventDefault();

            let Loading = Swal.fire
            (
                {
                    allowEscapeKey: false,
                    title: 'Đang kiểm tra',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    text: 'Vui lòng chờ trong giây lát...',
                    imageUrl: '../Themes/Images/Default/Loading.gif',
                }
            );

            let DoEditStatus = new FormData();

            DoEditStatus.append('SubjectID', $(this).attr('value'));
            DoEditStatus.append('Action', 'DeleteContact');

            await $.ajax
            (
                {
                    type: 'POST',
                    url: 'QGarden/AJAX.php',
                    dataType: 'JSON',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: DoEditStatus,
                    success: function (Respond)
                    {
                        if (Respond.StatusCode === 1)
                        {
                            Loading.close();

                            Swal.fire
                            (
                                {
                                    timer: 3000,
                                    type: 'success',
                                    title: 'Thành Công',
                                    text: 'Xóa Thành Công.',
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                }
                            );

                            window.location.reload();
                        }
                        else
                        {
                            Loading.close();

                            Swal.fire
                            (
                                {
                                    timer: 3000,
                                    type: 'error',
                                    title: 'Oops',
                                    text: 'Có lỗi xảy ra trong quá trình xử lý dữ liệu. Vui lòng thử lại sau.',
                                    showConfirmButton: true,
                                    showCancelButton: false,
                                }
                            );
                        }
                    },
                    error: function ()
                    {
                        Loading.close();

                        Swal.fire
                        (
                            {
                                timer: 3000,
                                type: 'error',
                                title: 'Có lỗi xảy ra trong quá trình xử lý dữ liệu. Vui lòng thử lại sau.',
                                showConfirmButton: true,
                                showCancelButton: false,
                            }
                        );
                    }

                }
            );
        });

        SetCancel.click(function (Event)
        {
            Event.preventDefault();
            console.log($(this).attr('value'));
            DoChangeBillStatus($(this).attr('value'), SubjectID);
        });

        SetShipping.click(function (Event)
        {
            Event.preventDefault();
            DoChangeBillStatus($(this).attr('value'), SubjectID);
        });

        SetDelivered.click(function (Event)
        {
            Event.preventDefault();
            DoChangeBillStatus($(this).attr('value'), SubjectID);
        });

        SetDeliveryFail.click(function (Event)
        {
            Event.preventDefault();
            DoChangeBillStatus($(this).attr('value'), SubjectID);
        });

        Edit.click(async function (Event)
        {
            Event.preventDefault();

            let Loading = Swal.fire
            (
                {
                    allowEscapeKey: false,
                    title: 'Đang kiểm tra',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    text: 'Vui lòng chờ trong giây lát...',
                    imageUrl: '../Themes/Images/Default/Loading.gif',
                }
            );

            let GetCategoryData = new FormData();

            GetCategoryData.append('SubjectID', SubjectID);
            GetCategoryData.append('Action', 'GetData');
            GetCategoryData.append('SubjectName', 'Category');
            await $.ajax
            (
                {
                    type: 'POST',
                    url: 'QGarden/AJAX.php',
                    dataType: 'JSON',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: GetCategoryData,
                    success: function (Respond)
                    {
                        if (Respond.StatusCode === 1)
                        {
                            Loading.close();
                            $('#AddCategory').remove();
                            $('#EditID').val(SubjectID);
                            $('#CategoryName').val(Respond.CategoryName);

                            $('form.hidden').not('#AddCategory').show();
                            $('#CategoryName').focus();
                        }
                        else
                        {
                            Loading.close();

                            Swal.fire
                            (
                                {
                                    timer: 3000,
                                    type: 'error',
                                    title: 'Có lỗi xảy ra trong quá trình xử lý dữ liệu. Vui lòng thử lại sau.',
                                    showConfirmButton: true,
                                    showCancelButton: false,
                                }
                            );
                        }
                    },
                    error: function ()
                    {
                        Loading.close();

                        Swal.fire
                        (
                            {
                                timer: 3000,
                                type: 'error',
                                title: 'Có lỗi xảy ra trong quá trình xử lý dữ liệu. Vui lòng thử lại sau.',
                                showConfirmButton: true,
                                showCancelButton: false,
                            }
                        );
                    }

                }
            );
        });

        DeleteNews.click(async function (Event)
        {
            Event.preventDefault();

            let Loading = Swal.fire
            (
                {
                    allowEscapeKey: false,
                    title: 'Đang kiểm tra',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    text: 'Vui lòng chờ trong giây lát...',
                    imageUrl: '../Themes/Images/Default/Loading.gif',
                }
            );

            let DoDelete = new FormData();

            DoDelete.append('SubjectName', 'News');
            DoDelete.append('Action', 'Delete');
            DoDelete.append('SubjectID', SubjectID);

            Loading.close();

            Swal.fire
            (
                {
                    type: 'warning',
                    title: 'Xác nhận xóa.?',
                    cancelButtonColor: '#3085d6',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Xác nhận xóa',
                    cancelButtonText: 'Hủy bỏ xóa',
                    showConfirmButton: true,
                    showCancelButton: true,
                }
            ).then
            (async (Confirm) =>
            {
                if (Confirm.value === true)
                {
                    await $.ajax
                    (
                        {
                            type: 'POST',
                            url: 'QGarden/AJAX.php',
                            dataType: 'JSON',
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: DoDelete,
                            success: function (Respond)
                            {
                                Loading.close();

                                if (Respond.StatusCode === 1)
                                {
                                    Swal.fire
                                    (
                                        {
                                            timer: 3000,
                                            type: 'success',
                                            title: 'Thành Công.',
                                            text: 'Xóa Tin Tức Thành Công',
                                            showConfirmButton: false,
                                            showCancelButton: false,
                                        }
                                    );
                                    window.location.reload();
                                }
                                else
                                {
                                    Swal.fire
                                    (
                                        {
                                            timer: 3000,
                                            type: 'error',
                                            title: 'Có lỗi xảy ra trong quá trình xử lý dữ liệu. Vui lòng thử lại sau.',
                                            showConfirmButton: true,
                                            showCancelButton: false,
                                        }
                                    );
                                }
                            },
                            error: function ()
                            {
                                Loading.close();

                                Swal.fire
                                (
                                    {
                                        timer: 3000,
                                        type: 'error',
                                        title: 'Có lỗi xảy ra trong quá trình xử lý dữ liệu. Vui lòng thử lại sau.',
                                        showConfirmButton: true,
                                        showCancelButton: false,
                                    }
                                );
                            }
                        }
                    )
                }
            });
        });

        Delete.click(async function (Event)
        {
            Event.preventDefault();

            let Loading = Swal.fire
            (
                {
                    allowEscapeKey: false,
                    title: 'Đang kiểm tra',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    text: 'Vui lòng chờ trong giây lát...',
                    imageUrl: '../Themes/Images/Default/Loading.gif',
                }
            );

            let DoDelete = new FormData();

            DoDelete.append('SubjectName', SubjectName);
            DoDelete.append('Action', 'Delete');
            DoDelete.append('SubjectID', SubjectID);

            await $.ajax
            (
                {
                    type: 'POST',
                    url: 'QGarden/AJAX.php',
                    dataType: 'JSON',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: DoDelete,
                    success: async function (Respond)
                    {
                        if (Respond.StatusCode === 1)
                        {
                            Loading.close();
                            await Swal.fire
                            (
                                {
                                    timer: 1500,
                                    type: 'success',
                                    title: 'Thành Công',
                                    text: 'Xóa danh mục thành công.',
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                }
                            );
                            window.location.reload();
                        }
                        else if (Respond.StatusCode === 2)
                        {
                            Loading.close();
                            Swal.fire
                            (
                                {
                                    type: 'warning',
                                    title: 'Xác nhận xóa.?',
                                    text: 'Việc này sẽ sóa tất cả các sản phẩm trong danh mục hiện tại.',
                                    cancelButtonColor: '#3085d6',
                                    confirmButtonColor: '#d33',
                                    confirmButtonText: 'Xác nhận xóa',
                                    cancelButtonText: 'Hủy bỏ xóa',
                                    showConfirmButton: true,
                                    showCancelButton: true,
                                }
                            ).then
                            ((Confirm) =>
                            {
                                if (Confirm.value === true)
                                {
                                    DoDelete.append('Confirm', true.toString());
                                    $.ajax(this);
                                }
                            });
                        }
                        else
                        {
                            Loading.close();

                            Swal.fire
                            (
                                {
                                    timer: 3000,
                                    type: 'error',
                                    title: 'Có lỗi xảy ra trong quá trình xử lý dữ liệu. Vui lòng thử lại sau.',
                                    showConfirmButton: true,
                                    showCancelButton: false,
                                }
                            );
                        }
                    },
                    error: function ()
                    {
                        Loading.close();

                        Swal.fire
                        (
                            {
                                timer: 3000,
                                type: 'error',
                                title: 'Có lỗi xảy ra trong quá trình xử lý dữ liệu. Vui lòng thử lại sau.',
                                showConfirmButton: true,
                                showCancelButton: false,
                            }
                        );
                    }

                }
            );

        });

        EditCoupon.click(async function (Event)
        {
            Event.preventDefault();

            let Loading = Swal.fire
            (
                {
                    allowEscapeKey: false,
                    title: 'Đang kiểm tra',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    text: 'Vui lòng chờ trong giây lát...',
                    imageUrl: '../Themes/Images/Default/Loading.gif',
                }
            );

            let GetData = new FormData();

            GetData.append('SubjectID', SubjectID);
            GetData.append('Action', 'GetData');
            GetData.append('SubjectName', 'Coupon');
            await $.ajax
            (
                {
                    type: 'POST',
                    url: 'QGarden/AJAX.php',
                    dataType: 'JSON',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: GetData,
                    success: function (Respond)
                    {
                        if (Respond.StatusCode === 1)
                        {
                            Loading.close();
                            $('#EditID').val(SubjectID);
                            $('#EditDiscount').val(Respond.Discount);
                            $('#EditCouponCode').val(Respond.CouponCode);
                            $('#EditExpireDate').val(Respond.ExpireDate);

                            $('form#cedit.hidden').show();
                            $('#CouponCode').focus();
                        }
                        else
                        {
                            Loading.close();

                            Swal.fire
                            (
                                {
                                    timer: 3000,
                                    type: 'error',
                                    title: 'Có lỗi xảy ra trong quá trình xử lý dữ liệu. Vui lòng thử lại sau.',
                                    showConfirmButton: true,
                                    showCancelButton: false,
                                }
                            );
                        }
                    },
                    error: function ()
                    {
                        Loading.close();

                        Swal.fire
                        (
                            {
                                timer: 3000,
                                type: 'error',
                                title: 'Có lỗi xảy ra trong quá trình xử lý dữ liệu. Vui lòng thử lại sau.',
                                showConfirmButton: true,
                                showCancelButton: false,
                            }
                        );
                    }

                }
            );
        });

        DeleteCoupon.click(async function (Event)
        {
            Event.preventDefault();

            let Loading = Swal.fire
            (
                {
                    allowEscapeKey: false,
                    title: 'Đang kiểm tra',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    text: 'Vui lòng chờ trong giây lát...',
                    imageUrl: '../Themes/Images/Default/Loading.gif',
                }
            );

            let DoDelete = new FormData();

            DoDelete.append('SubjectName', 'Coupon');
            DoDelete.append('Action', 'Delete');
            DoDelete.append('SubjectID', SubjectID);

            await $.ajax
            (
                {
                    type: 'POST',
                    url: 'QGarden/AJAX.php',
                    dataType: 'JSON',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: DoDelete,
                    success: async function (Respond)
                    {
                        if (Respond.StatusCode === 1)
                        {
                            Loading.close();
                            await Swal.fire
                            (
                                {
                                    timer: 1500,
                                    type: 'success',
                                    title: 'Thành Công',
                                    text: 'Xóa mã giảm giá thành công.',
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                }
                            );
                            window.location.reload();
                        }
                        else
                        {
                            Loading.close();

                            Swal.fire
                            (
                                {
                                    timer: 3000,
                                    type: 'error',
                                    title: 'Có lỗi xảy ra trong quá trình xử lý dữ liệu. Vui lòng thử lại sau.',
                                    showConfirmButton: true,
                                    showCancelButton: false,
                                }
                            );
                        }
                    },
                    error: function ()
                    {
                        Loading.close();

                        Swal.fire
                        (
                            {
                                timer: 3000,
                                type: 'error',
                                title: 'Có lỗi xảy ra trong quá trình xử lý dữ liệu. Vui lòng thử lại sau.',
                                showConfirmButton: true,
                                showCancelButton: false,
                            }
                        );
                    }

                }
            );

        });

        BlockUser.click(async function (Event)
        {
            Event.preventDefault();

            let Loading = Swal.fire
            (
                {
                    allowEscapeKey: false,
                    title: 'Đang kiểm tra',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    text: 'Vui lòng chờ trong giây lát...',
                    imageUrl: '../Themes/Images/Default/Loading.gif',
                }
            );

            let UserData = new FormData();

            UserData.append('SubjectID', SubjectID);
            UserData.append('Action', 'Block');

            Swal.fire
            (
                {
                    type: 'warning',
                    title: 'Xác nhận khóa người dùng này.?',
                    cancelButtonColor: '#3085d6',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Xác nhận khóa',
                    cancelButtonText: 'Hủy bỏ',
                    showConfirmButton: true,
                    showCancelButton: true,
                }
            ).then
            (async (Confirm) =>
            {
                if (Confirm.value === true)
                {
                    await $.ajax
                    (
                        {
                            type: 'POST',
                            url: 'QGarden/AJAX.php',
                            dataType: 'JSON',
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: UserData,
                            success: async function (Respond)
                            {
                                if (Respond.StatusCode === 1)
                                {
                                    Loading.close();
                                    await Swal.fire
                                    (
                                        {
                                            timer: 3000,
                                            type: 'success',
                                            title: 'Thành Công',
                                            text: 'Khóa người dùng thành công.',
                                            showConfirmButton: false,
                                            showCancelButton: false,
                                        }
                                    );
                                    window.location.reload();
                                }
                                else
                                {
                                    Loading.close();

                                    Swal.fire
                                    (
                                        {
                                            timer: 3000,
                                            type: 'error',
                                            title: 'Có lỗi xảy ra trong quá trình xử lý dữ liệu. Vui lòng thử lại sau.',
                                            showConfirmButton: true,
                                            showCancelButton: false,
                                        }
                                    );
                                }
                            },
                            error: function ()
                            {
                                Loading.close();

                                Swal.fire
                                (
                                    {
                                        timer: 3000,
                                        type: 'error',
                                        title: 'Có lỗi xảy ra trong quá trình xử lý dữ liệu. Vui lòng thử lại sau.',
                                        showConfirmButton: true,
                                        showCancelButton: false,
                                    }
                                );
                            }

                        }
                    );
                }
            });
        });

        UnblockUser.click(async function (Event)
        {
            Event.preventDefault();

            let Loading = Swal.fire
            (
                {
                    allowEscapeKey: false,
                    title: 'Đang kiểm tra',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    text: 'Vui lòng chờ trong giây lát...',
                    imageUrl: '../Themes/Images/Default/Loading.gif',
                }
            );

            let UserData = new FormData();

            UserData.append('SubjectID', SubjectID);
            UserData.append('Action', 'Unblock');

            Swal.fire
            (
                {
                    type: 'warning',
                    title: 'Xác nhận mở khóa người dùng này.?',
                    cancelButtonColor: '#3085d6',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Xác nhận mở khóa',
                    cancelButtonText: 'Hủy bỏ',
                    showConfirmButton: true,
                    showCancelButton: true,
                }
            ).then
            (async (Confirm) =>
            {
                if (Confirm.value === true)
                {
                    await $.ajax
                    (
                        {
                            type: 'POST',
                            url: 'QGarden/AJAX.php',
                            dataType: 'JSON',
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: UserData,
                            success: async function (Respond)
                            {
                                if (Respond.StatusCode === 1)
                                {
                                    Loading.close();
                                    await Swal.fire
                                    (
                                        {
                                            timer: 3000,
                                            type: 'success',
                                            title: 'Thành Công',
                                            text: 'Mở khóa người dùng thành công.',
                                            showConfirmButton: false,
                                            showCancelButton: false,
                                        }
                                    );
                                    window.location.reload();
                                }
                                else
                                {
                                    Loading.close();

                                    Swal.fire
                                    (
                                        {
                                            timer: 3000,
                                            type: 'error',
                                            title: 'Có lỗi xảy ra trong quá trình xử lý dữ liệu. Vui lòng thử lại sau.',
                                            showConfirmButton: true,
                                            showCancelButton: false,
                                        }
                                    );
                                }
                            },
                            error: function ()
                            {
                                Loading.close();

                                Swal.fire
                                (
                                    {
                                        timer: 3000,
                                        type: 'error',
                                        title: 'Có lỗi xảy ra trong quá trình xử lý dữ liệu. Vui lòng thử lại sau.',
                                        showConfirmButton: true,
                                        showCancelButton: false,
                                    }
                                );
                            }

                        }
                    );
                }
            });
        });

        MakeSuperUser.click(async function (Event)
        {
            Event.preventDefault();

            let Loading = Swal.fire
            (
                {
                    allowEscapeKey: false,
                    title: 'Đang kiểm tra',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    text: 'Vui lòng chờ trong giây lát...',
                    imageUrl: '../Themes/Images/Default/Loading.gif',
                }
            );

            let UserData = new FormData();

            UserData.append('SubjectID', SubjectID);
            UserData.append('Action', 'MakeSuper');

            Swal.fire
            (
                {
                    type: 'warning',
                    title: 'Xác nhận kích hoạt người dùng này thành Super.?',
                    cancelButtonColor: '#3085d6',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Xác nhận',
                    cancelButtonText: 'Hủy bỏ',
                    showConfirmButton: true,
                    showCancelButton: true,
                }
            ).then
            (async (Confirm) =>
            {
                if (Confirm.value === true)
                {
                    await $.ajax
                    (
                        {
                            type: 'POST',
                            url: 'QGarden/AJAX.php',
                            dataType: 'JSON',
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: UserData,
                            success: async function (Respond)
                            {
                                if (Respond.StatusCode === 1)
                                {
                                    Loading.close();
                                    await Swal.fire
                                    (
                                        {
                                            timer: 3000,
                                            type: 'success',
                                            title: 'Thành Công',
                                            text: 'Cấp quyền thành công.',
                                            showConfirmButton: false,
                                            showCancelButton: false,
                                        }
                                    );
                                    window.location.reload();
                                }
                                else
                                {
                                    Loading.close();

                                    Swal.fire
                                    (
                                        {
                                            timer: 3000,
                                            type: 'error',
                                            title: 'Có lỗi xảy ra trong quá trình xử lý dữ liệu. Vui lòng thử lại sau.',
                                            showConfirmButton: true,
                                            showCancelButton: false,
                                        }
                                    );
                                }
                            },
                            error: function ()
                            {
                                Loading.close();

                                Swal.fire
                                (
                                    {
                                        timer: 3000,
                                        type: 'error',
                                        title: 'Có lỗi xảy ra trong quá trình xử lý dữ liệu. Vui lòng thử lại sau.',
                                        showConfirmButton: true,
                                        showCancelButton: false,
                                    }
                                );
                            }

                        }
                    );
                }
            });
        });
    });

    $('#DoCategoryEdit').click(async function (Event)
    {
        Event.preventDefault();

        let Loading = Swal.fire
        (
            {
                allowEscapeKey: false,
                title: 'Đang kiểm tra',
                allowOutsideClick: false,
                showConfirmButton: false,
                text: 'Vui lòng chờ trong giây lát...',
                imageUrl: '../Themes/Images/Default/Loading.gif',
            }
        );

        let CategoryID = $('#EditID').val();
        let CategoryName = $('#CategoryName').val();

        if (CategoryName === "")
        {
            Swal.fire
            (
                {
                    type: 'error',
                    title: 'Oops',
                    text: 'Vui lòng nhập Tên Danh Mục.',
                    showConfirmButton: true,
                    showCancelButton: false
                }
            );
            return;
        }

        let CategoryEdit = new FormData();

        if ($('#input-category-image')['0'].files.length !== 0)
        {
            CategoryEdit.append('CategoryImage', $('#input-category-image')['0'].files['0']);
        }

        CategoryEdit.append('Action', 'Edit');
        CategoryEdit.append('SubjectID', CategoryID);
        CategoryEdit.append('CategoryName', CategoryName);
        CategoryEdit.append('SubjectName', 'Category');

        await $.ajax
        (
            {
                type: 'POST',
                url: 'QGarden/AJAX.php',
                dataType: 'JSON',
                cache: false,
                contentType: false,
                processData: false,
                data: CategoryEdit,
                success: async function (Respond)
                {
                    if (Respond.StatusCode === 1)
                    {
                        Loading.close();

                        await Swal.fire
                        (
                            {
                                timer:1500,
                                type: 'success',
                                title: 'Thành Công',
                                text: 'Sửa Thành Công.',
                                showConfirmButton: false,
                                showCancelButton: false,
                            }
                        );
                        window.location.reload();
                    }
                    else
                    {
                        Loading.close();

                        Swal.fire
                        (
                            {
                                timer: 3000,
                                type: 'error',
                                title: 'Có lỗi xảy ra trong quá trình xử lý dữ liệu. Vui lòng thử lại sau.',
                                showConfirmButton: true,
                                showCancelButton: false,
                            }
                        );
                    }
                },
                error: function ()
                {
                    Loading.close();

                    Swal.fire
                    (
                        {
                            timer: 3000,
                            type: 'error',
                            title: 'Có lỗi xảy ra trong quá trình xử lý dữ liệu. Vui lòng thử lại sau.',
                            showConfirmButton: true,
                            showCancelButton: false,
                        }
                    );
                }

            }
        );
    });

    $('#DoProductEdit').click(async function (Event)
    {
        Event.preventDefault();

        let ProductID = $('#ProductID').val(),
            ProductName = $('#ProductName').val(),
            ProductCategoryID = $('#ProductCategory').val(),
            ProductPrice = $('#ProductPrice').val(),
            ProductDiscount = $('#ProductDiscount').val(),
            ProductAvailable = $('#ProductAvailable').val(),
            ProductDecs = tinymce.activeEditor.getContent(),
            ProductPreview = $('#ProductPreview').val();

        let Loading = Swal.fire
        (
            {
                allowEscapeKey: false,
                title: 'Đang kiểm tra',
                allowOutsideClick: false,
                showConfirmButton: false,
                text: 'Vui lòng chờ trong giây lát...',
                imageUrl: '../Themes/Images/Default/Loading.gif',
            }
        );

        let ProductEdit = new FormData();

        if (ProductID === "")
        {
            Swal.fire
            (
                {
                    type: 'error',
                    title: 'Oops',
                    text: 'Lỗi xử lý dữ liệu. Vui lòng kiểm tra lỗi.',
                    showConfirmButton: true,
                }
            )
        }
        else
        {
            ProductEdit.append('Action', 'Edit');
            ProductEdit.append('SubjectID', ProductID);
            ProductEdit.append('SubjectName', 'Product');
        }

        if (ProductName !== "") ProductEdit.append('ProductName', ProductName);
        if (ProductDecs !== "") ProductEdit.append('ProductDecs', ProductDecs);
        if (ProductPrice !== "") ProductEdit.append('ProductPrice', ProductPrice);
        if (ProductPreview !== "") ProductEdit.append('ProductPreview', ProductPreview);
        if (ProductDiscount !== "") ProductEdit.append('ProductDiscount', ProductDiscount);
        if (ProductAvailable !== "") ProductEdit.append('ProductAvailable', ProductAvailable);
        if (ProductCategoryID !== "") ProductEdit.append('ProductCategoryID', ProductCategoryID);

        if ($('#input-category-image')['0'].files.length !== 0)
        {
            let Loop = 0;
            let FilesLength = $('#input-category-image')['0'].files.length;
            while (Loop < FilesLength)
            {
                ProductEdit.append('ProductImage[]', $('#input-category-image')['0'].files[Loop]);
                Loop++;
            }
        }

        await $.ajax
        (
            {
                type: 'POST',
                url: 'QGarden/AJAX.php',
                dataType: 'JSON',
                cache: false,
                contentType: false,
                processData: false,
                data: ProductEdit,
                success: async function (Respond)
                {
                    if (Respond.StatusCode === 1)
                    {
                        Loading.close();

                        await Swal.fire
                        (
                            {
                                timer:1500,
                                type: 'success',
                                title: 'Thành Công',
                                text: 'Sửa Thành Công.',
                                showConfirmButton: false,
                                showCancelButton: false,
                            }
                        );
                        window.location.href = "?Admin=Products";
                    }
                    else
                    {
                        Loading.close();

                        Swal.fire
                        (
                            {
                                timer: 3000,
                                type: 'error',
                                title: 'Có lỗi xảy ra trong quá trình xử lý dữ liệu. Vui lòng thử lại sau.',
                                showConfirmButton: true,
                                showCancelButton: false,
                            }
                        );
                    }
                },
                error: function ()
                {
                    Loading.close();

                    Swal.fire
                    (
                        {
                            timer: 3000,
                            type: 'error',
                            title: 'Có lỗi xảy ra trong quá trình xử lý dữ liệu. Vui lòng thử lại sau.',
                            showConfirmButton: true,
                            showCancelButton: false,
                        }
                    );
                }
            }
        );

    });

    jQuery('section.QGProductList > div.product-container').each(function ()
    {
        let Spinner = jQuery(this);
        let DoDelete = Spinner.find('a#DoDeleteProduct');

        DoDelete.click(async function (Event)
        {
            Event.stopPropagation();
            Event.preventDefault();

            let Loading = Swal.fire
            (
                {
                    allowEscapeKey: false,
                    title: 'Đang kiểm tra',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    text: 'Vui lòng chờ trong giây lát...',
                    imageUrl: '../Themes/Images/Default/Loading.gif',
                }
            );

            let SubjectID = $(this).attr('value');

            let DoDelete = new FormData();

            DoDelete.append('SubjectID', SubjectID);
            DoDelete.append('Action', 'Delete');
            DoDelete.append('SubjectName', 'Product');

            Swal.fire
            (
                {
                    type: 'warning',
                    title: 'Xác nhận xóa.?',
                    confirmButtonText: 'Xác nhận',
                    cancelButtonText: 'Hủy Xóa',
                    cancelButtonColor: '#3085d6',
                    confirmButtonColor: '#d33',
                    showCancelButton: true,
                }
            ).then(async (Result) =>
            {
                if (Result.value === true)
                {
                    await $.ajax
                    (
                        {
                            type: 'POST',
                            url: 'QGarden/AJAX.php',
                            dataType: 'JSON',
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: DoDelete,
                            success: async function (Respond)
                            {
                                if (Respond.StatusCode === 1)
                                {
                                    Loading.close();

                                    await Swal.fire
                                    (
                                        {
                                            type: 'success',
                                            title: 'Thành Công',
                                            text: 'Xóa Thành Công.',
                                            showConfirmButton: false,
                                            showCancelButton: false,
                                            timer : 1500
                                        }
                                    );
                                    window.location.reload();
                                }
                                else
                                {
                                    Loading.close();

                                    Swal.fire
                                    (
                                        {
                                            timer: 3000,
                                            type: 'error',
                                            title: 'Có lỗi xảy ra trong quá trình xử lý dữ liệu. Vui lòng thử lại sau.',
                                            showConfirmButton: true,
                                            showCancelButton: false,
                                        }
                                    );
                                }
                            },
                            error: function ()
                            {
                                Loading.close();

                                Swal.fire
                                (
                                    {
                                        timer: 3000,
                                        type: 'error',
                                        title: 'Có lỗi xảy ra trong quá trình xử lý dữ liệu. Vui lòng thử lại sau.',
                                        showConfirmButton: true,
                                        showCancelButton: false,
                                    }
                                );
                            }
                        }
                    );
                }
            })
        })

    });

    $('#ClearSearch').click(function (Event)
    {
        Event.preventDefault();

        window.location.href = '?Admin=Users';
    });

    $('#AddNew').click(function (Event)
    {
        Event.preventDefault();

        $(this).hidden;

        $('#cadd').show();
    });

    $('#DoCouponEdit').click(async function (Event)
    {
        Event.preventDefault();

        let Loading = Swal.fire
        (
            {
                allowEscapeKey: false,
                title: 'Đang kiểm tra',
                allowOutsideClick: false,
                showConfirmButton: false,
                text: 'Vui lòng chờ trong giây lát...',
                imageUrl: '../Themes/Images/Default/Loading.gif',
            }
        );

        let CouponID = $('#EditID').val();
        let CouponCode = $('#EditCouponCode').val();
        let CouponDiscount = $('#EditDiscount').val();
        let CouponExpireDate = $('#EditExpireDate').val();

        if (parseInt(CouponDiscount) > 90)
        {
            Swal.fire
            (
                {
                    type: 'error',
                    title: 'Oops',
                    text: 'Mức giảm giá tối đa là 90%.',
                    showConfirmButton: true,
                    showCancelButton: false
                }
            );
            return;
        }

        let CouponEdit = new FormData();

        CouponEdit.append('Action', 'Edit');
        CouponEdit.append('SubjectID', CouponID);
        CouponEdit.append('SubjectName', 'Coupon');

        if (CouponCode) CouponEdit.append('CouponCode', CouponCode);
        if (CouponDiscount) CouponEdit.append('CouponDiscount', CouponDiscount);
        if (CouponExpireDate) CouponEdit.append('CouponExpireDate', CouponExpireDate);

        await $.ajax
        (
            {
                type: 'POST',
                url: 'QGarden/AJAX.php',
                dataType: 'JSON',
                cache: false,
                contentType: false,
                processData: false,
                data: CouponEdit,
                success: async function (Respond)
                {
                    if (Respond.StatusCode === 1)
                    {
                        Loading.close();

                        await Swal.fire
                        (
                            {
                                timer:1500,
                                type: 'success',
                                title: 'Thành Công',
                                text: 'Sửa Thành Công.',
                                showConfirmButton: false,
                                showCancelButton: false,
                            }
                        );
                        window.location.href = "?Admin=Coupons";
                    }
                    else
                    {
                        Loading.close();

                        Swal.fire
                        (
                            {
                                timer: 3000,
                                type: 'error',
                                title: 'Có lỗi xảy ra trong quá trình xử lý dữ liệu. Vui lòng thử lại sau.',
                                showConfirmButton: true,
                                showCancelButton: false,
                            }
                        );
                    }
                },
                error: function ()
                {
                    Loading.close();

                    Swal.fire
                    (
                        {
                            timer: 3000,
                            type: 'error',
                            title: 'Có lỗi xảy ra trong quá trình xử lý dữ liệu. Vui lòng thử lại sau.',
                            showConfirmButton: true,
                            showCancelButton: false,
                        }
                    );
                }
            }
        );
    });

    $('#DoCouponAdd').click(async function (Event)
    {
        Event.preventDefault();

        let Loading = Swal.fire
        (
            {
                allowEscapeKey: false,
                title: 'Đang kiểm tra',
                allowOutsideClick: false,
                showConfirmButton: false,
                text: 'Vui lòng chờ trong giây lát...',
                imageUrl: '../Themes/Images/Default/Loading.gif',
            }
        );

        let CouponCode = $('#CouponCode').val();
        let CouponDiscount = $('#Discount').val();
        let CouponExpireDate = $('#ExpireDate').val();

        if (parseInt(CouponDiscount) > 90)
        {
            Swal.fire
            (
                {
                    type: 'error',
                    title: 'Oops',
                    text: 'Mức giảm giá tối đa là 90%.',
                    showConfirmButton: true,
                    showCancelButton: false
                }
            );
            return;
        }

        let CouponEdit = new FormData();

        CouponEdit.append('Action', 'Add');
        CouponEdit.append('SubjectName', 'Coupon');

        if (CouponCode) CouponEdit.append('CouponCode', CouponCode);
        if (CouponDiscount) CouponEdit.append('CouponDiscount', CouponDiscount);
        if (CouponExpireDate) CouponEdit.append('CouponExpireDate', CouponExpireDate);

        await $.ajax
        (
            {
                type: 'POST',
                url: 'QGarden/AJAX.php',
                dataType: 'JSON',
                cache: false,
                contentType: false,
                processData: false,
                data: CouponEdit,
                success: async function (Respond)
                {
                    if (Respond.StatusCode === 1)
                    {
                        Loading.close();

                        await Swal.fire
                        (
                            {
                                timer:1500,
                                type: 'success',
                                title: 'Thành Công',
                                text: 'Thêm Thành Công.',
                                showConfirmButton: false,
                                showCancelButton: false,
                            }
                        );
                        window.location.href = "?Admin=Coupons";
                    }
                    else
                    {
                        Loading.close();

                        Swal.fire
                        (
                            {
                                timer: 3000,
                                type: 'error',
                                title: 'Có lỗi xảy ra trong quá trình xử lý dữ liệu. Vui lòng thử lại sau.',
                                showConfirmButton: true,
                                showCancelButton: false,
                            }
                        );
                    }
                },
                error: function ()
                {
                    Loading.close();

                    Swal.fire
                    (
                        {
                            timer: 3000,
                            type: 'error',
                            title: 'Có lỗi xảy ra trong quá trình xử lý dữ liệu. Vui lòng thử lại sau.',
                            showConfirmButton: true,
                            showCancelButton: false,
                        }
                    );
                }
            }
        );
    });

    $('#Temple').on('change', function ()
    {
        if ($('#Temple').val() === "2")
        {
            $('#input-coupon').show();
        } else $('#input-coupon').hidden;
    });

    $('#DoMail').click(async function (Event)
    {
        Event.preventDefault();

        let Loading = Swal.fire
        (
            {
                allowEscapeKey: false,
                title: 'Đang kiểm tra',
                allowOutsideClick: false,
                showConfirmButton: false,
                text: 'Vui lòng chờ trong giây lát...',
                imageUrl: '../Themes/Images/Default/Loading.gif',
            }
        );

        let Coupon = $('#Coupon').val();
        let MailList = $('#MailList').val();
        let UserList = $('#UserList').val();
        let FromMail = $('#FromMail').val();
        let MailTitle = $('#MailTitle').val();
        let Content = tinymce.activeEditor.getContent();

        let MailArray = MailList.split(',');
        let UserArray = UserList.split(',');

        let ErrorMessage = "";

        if (FromMail === "") ErrorMessage += "Vui lòng nhập địa chỉ gửi.<br>";
        if (MailList === "") ErrorMessage += "Vui lòng nhập danh sách mail.<br>";
        if (UserList === "") ErrorMessage += "Vui lòng nhập danh sách tên người nhận.<br>";
        if (MailArray.length !== UserArray.length) ErrorMessage += "Danh sách Mail và Tên không khớp.<br>";

        if ($("#Temple").val() === "2")
        {
            if ($('#Coupon').val === "") ErrorMessage += "Vui lòng nhập mã giảm giá.<br>";
        }

        if ($("#Temple").val() === "" && Content === "") ErrorMessage += "Vui lòng nhập nội dung mail.<br>";

        if (ErrorMessage !== "")
        {
            Loading.close();
            Swal.fire
            (
                {
                    type: 'error',
                    title: 'Oops',
                    html: ErrorMessage,
                    showConfirmButton: true,
                }
            );
            return;
        }

        let MailData = new FormData();

        MailData.append('Action', 'SendMail');
        MailData.append('Temple', $('#Temple').val());

        if (Content !== "") MailData.append('Content', Content);
        if (Coupon !== "") MailData.append('CouponCode', Coupon);
        if (FromMail !== "") MailData.append('FromMail', FromMail);
        if (MailList !== "") MailData.append('MailList', MailList);
        if (UserList !== "") MailData.append('UserList', UserList);
        if (MailTitle !== "") MailData.append('MailTitle', MailTitle);

        await $.ajax
        (
            {
                type: 'POST',
                url: 'QGarden/AJAX.php',
                dataType: 'JSON',
                cache: false,
                contentType: false,
                processData: false,
                data: MailData,
                success: async function (Respond)
                {
                    if (Respond.StatusCode === 1)
                    {
                        Loading.close();

                        await Swal.fire
                        (
                            {
                                timer:1500,
                                type: 'success',
                                title: 'Thành Công',
                                text: 'Gửi Thành Công.',
                                showConfirmButton: false,
                                showCancelButton: false,
                            }
                        );
                        window.location.href = "?Admin=Mail";
                    }
                    else
                    {
                        Loading.close();

                        Swal.fire
                        (
                            {
                                timer: 3000,
                                type: 'error',
                                title: 'Có lỗi xảy ra trong quá trình xử lý dữ liệu. Vui lòng thử lại sau.',
                                showConfirmButton: true,
                                showCancelButton: false,
                            }
                        );
                    }
                },
                error: function ()
                {
                    Loading.close();

                    Swal.fire
                    (
                        {
                            timer: 3000,
                            type: 'error',
                            title: 'Có lỗi xảy ra trong quá trình xử lý dữ liệu. Vui lòng thử lại sau.',
                            showConfirmButton: true,
                            showCancelButton: false,
                        }
                    );
                }
            }
        );
    });

    $('#DoEditNews').click(async function (Event)
    {
        Event.preventDefault();

        let Loading = Swal.fire
        (
            {
                allowEscapeKey: false,
                title: 'Đang kiểm tra',
                allowOutsideClick: false,
                showConfirmButton: false,
                text: 'Vui lòng chờ trong giây lát...',
                imageUrl: '../Themes/Images/Default/Loading.gif',
            }
        );

        let NewsID = $('#SubjectID').val();
        let NewsTittle = $('#NewsTitle').val();
        let NewsPreview = $('#NewsPreview').val();
        let NewsContent = tinymce.activeEditor.getContent();

        let EditData = new FormData();

        EditData.append('SubjectID', NewsID);
        EditData.append('Action', 'Edit');
        EditData.append('SubjectName', 'News');

        if(NewsTittle !== "") EditData.append('NewsTitle', NewsTittle);
        if(NewsTittle !== "") EditData.append('NewsPreview', NewsPreview);
        if(NewsTittle !== "") EditData.append('NewsContent', NewsContent);

        if ($('#input-category-image')['0'].files.length !== 0)
        {
            EditData.append('NewsImage', $('#input-category-image')['0'].files[0]);
        }

        await $.ajax
        (
            {
                type: 'POST',
                url: 'QGarden/AJAX.php',
                dataType: 'JSON',
                cache: false,
                contentType: false,
                processData: false,
                data: EditData,
                success: async function (Respond)
                {
                    if (Respond.StatusCode === 1)
                    {
                        Loading.close();

                        await Swal.fire
                        (
                            {
                                timer:1500,
                                type: 'success',
                                title: 'Thành Công',
                                text: 'Sửa Thành Công.',
                                showConfirmButton: false,
                                showCancelButton: false,
                            }
                        );
                        window.location.href = "?Admin=News";
                    }
                    else
                    {
                        Loading.close();

                        Swal.fire
                        (
                            {
                                timer: 3000,
                                type: 'error',
                                title: 'Có lỗi xảy ra trong quá trình xử lý dữ liệu. Vui lòng thử lại sau.',
                                showConfirmButton: true,
                                showCancelButton: false,
                            }
                        );
                    }
                },
                error: function ()
                {
                    Loading.close();

                    Swal.fire
                    (
                        {
                            timer: 3000,
                            type: 'error',
                            title: 'Có lỗi xảy ra trong quá trình xử lý dữ liệu. Vui lòng thử lại sau.',
                            showConfirmButton: true,
                            showCancelButton: false,
                        }
                    );
                }
            }
        );
    });

    $('#DoProductAdd').click(async function (Event)
    {
        Event.preventDefault();

        let ProductName = $('#ProductName').val(),
            ProductCategoryID = $('#ProductCategory').val(),
            ProductPrice = $('#ProductPrice').val(),
            ProductDiscount = $('#ProductDiscount').val(),
            ProductAvailable = $('#ProductAvailable').val(),
            ProductDecs = tinymce.activeEditor.getContent(),
            ProductPreview = $('#ProductPreview').val();

        let ErrorMessage = "";

        let Loading = Swal.fire
        (
            {
                allowEscapeKey: false,
                title: 'Đang kiểm tra',
                allowOutsideClick: false,
                showConfirmButton: false,
                text: 'Vui lòng chờ trong giây lát...',
                imageUrl: '../Themes/Images/Default/Loading.gif',
            }
        );

        let AddData = new FormData();
        AddData.append('Action', 'Add');
        AddData.append('SubjectName', 'Product');

        if (ProductName === "") ErrorMessage += 'Vui lòng nhập tên sản phẩm.<br>';
        else AddData.append('ProductName', ProductName);

        if (ProductCategoryID === "") ErrorMessage += 'Vui lòng chọn danh mục sản phẩm.<br>';
        else AddData.append('ProductCategoryID', ProductCategoryID);

        if (ProductPrice === "") ErrorMessage += 'Vui lòng nhập giá sản phẩm.<br>';
        else AddData.append('ProductPrice', ProductPrice);

        if (ProductAvailable === "") ErrorMessage += 'Vui lòng nhập số lượng sản phẩm nhập.<br>';
        else AddData.append('ProductAvailable', ProductAvailable);

        if (ProductDecs === "") ErrorMessage += 'Vui lòng nhập mô tả sản phẩm.<br>';
        else AddData.append('ProductDecs', ProductDecs);

        if (ProductPreview === "") ErrorMessage += 'Vui lòng nhập mô tả ngắn gọn sản phẩm.<br>';
        else AddData.append('ProductPreview', ProductPreview);

        if ($('#input-category-image')['0'].files.length !== 0)
        {
            let Loop = 0;
            let FilesLength = $('#input-category-image')['0'].files.length;
            while (Loop < FilesLength)
            {
                AddData.append('ProductImage[]', $('#input-category-image')['0'].files[Loop]);
                Loop++;
            }
        }

        if (ProductDiscount !== "")
        {
            if (ProductDiscount > 90 || ProductDiscount < 0)
            {
                ErrorMessage += "Giá trị giảm giá cho phép từ 0 dến 90 (%).<br>";
            }else AddData.append('ProductDiscount', ProductDiscount);
        } else AddData.append('ProductDiscount', '0');

        if (ErrorMessage !== "")
        {
            Loading.close();
            Swal.fire
            (
                {
                    type: 'error',
                    title: 'Oops',
                    html:ErrorMessage,
                    showConfirmButton: true,
                }
            );

            return;
        }

        await $.ajax
        (
            {
                type: 'POST',
                url: 'QGarden/AJAX.php',
                dataType: 'JSON',
                cache: false,
                contentType: false,
                processData: false,
                data: AddData,
                success: async function (Respond)
                {
                    if (Respond.StatusCode === 1)
                    {
                        Loading.close();

                        await Swal.fire
                        (
                            {
                                timer:1500,
                                type: 'success',
                                title: 'Thành Công',
                                text: 'Thêm Thành Công.',
                                showConfirmButton: false,
                                showCancelButton: false,
                            }
                        );
                        $('#productForm')['0'].reset();
                    }
                    else
                    {
                        Loading.close();

                        Swal.fire
                        (
                            {
                                timer: 3000,
                                type: 'error',
                                title: 'Có lỗi xảy ra trong quá trình xử lý dữ liệu. Vui lòng thử lại sau.',
                                showConfirmButton: true,
                                showCancelButton: false,
                            }
                        );
                    }
                },
                error: function ()
                {
                    Loading.close();

                    Swal.fire
                    (
                        {
                            timer: 3000,
                            type: 'error',
                            title: 'Có lỗi xảy ra trong quá trình xử lý dữ liệu. Vui lòng thử lại sau.',
                            showConfirmButton: true,
                            showCancelButton: false,
                        }
                    );
                }
            }
        );
    });

    $('#DoAddNews').click(async function (Event)
    {
        Event.preventDefault();

        let Loading = Swal.fire
        (
            {
                allowEscapeKey: false,
                title: 'Đang kiểm tra',
                allowOutsideClick: false,
                showConfirmButton: false,
                text: 'Vui lòng chờ trong giây lát...',
                imageUrl: '../Themes/Images/Default/Loading.gif',
            }
        );

        let NewsTittle = $('#NewsTitle').val();
        let NewsPreview = $('#NewsPreview').val();
        let NewsContent = tinymce.activeEditor.getContent();

        let ErrorMessage = "";

        let EditData = new FormData();

        EditData.append('Action', 'Add');
        EditData.append('SubjectName', 'News');

        if(NewsTittle !== "") EditData.append('NewsTitle', NewsTittle);
        else ErrorMessage += "Vui lòng nhập tiêu đề tin.<br>";
        if(NewsTittle !== "") EditData.append('NewsPreview', NewsPreview);
        else ErrorMessage += "Vui lòng nhập mô tả tin.<br>";
        if(NewsTittle !== "") EditData.append('NewsContent', NewsContent);
        else ErrorMessage += "Vui lòng nhập nội dung tin.<br>";

        if ($('#input-category-image')['0'].files.length !== 0)
        {
            EditData.append('NewsImage', $('#input-category-image')['0'].files[0]);
        } else ErrorMessage += "Vui lòng chọn ảnh bìa tin.<br>";

        if (ErrorMessage !== "")
        {
            Swal.fire
            (
                {
                    type: 'error',
                    title: 'Oops',
                    html: ErrorMessage,
                    showConfirmButton: true,
                }
            ); return;
        }

        await $.ajax
        (
            {
                type: 'POST',
                url: 'QGarden/AJAX.php',
                dataType: 'JSON',
                cache: false,
                contentType: false,
                processData: false,
                data: EditData,
                success: async function (Respond)
                {
                    if (Respond.StatusCode === 1)
                    {
                        Loading.close();

                        await Swal.fire
                        (
                            {
                                timer:1500,
                                type: 'success',
                                title: 'Thành Công',
                                text: 'Thêm Thành Công.',
                                showConfirmButton: false,
                                showCancelButton: false,
                            }
                        );
                        window.location.href = "?Admin=News";
                    }
                    else
                    {
                        Loading.close();

                        Swal.fire
                        (
                            {
                                timer: 3000,
                                type: 'error',
                                title: 'Có lỗi xảy ra trong quá trình xử lý dữ liệu. Vui lòng thử lại sau.',
                                showConfirmButton: true,
                                showCancelButton: false,
                            }
                        );
                    }
                },
                error: function ()
                {
                    Loading.close();

                    Swal.fire
                    (
                        {
                            timer: 3000,
                            type: 'error',
                            title: 'Có lỗi xảy ra trong quá trình xử lý dữ liệu. Vui lòng thử lại sau.',
                            showConfirmButton: true,
                            showCancelButton: false,
                        }
                    );
                }
            }
        );
    });

    $('#DoCategoryAdd').click(async function (Event)
    {
        Event.preventDefault();

        let Loading = Swal.fire
        (
            {
                allowEscapeKey: false,
                title: 'Đang kiểm tra',
                allowOutsideClick: false,
                showConfirmButton: false,
                text: 'Vui lòng chờ trong giây lát...',
                imageUrl: '../Themes/Images/Default/Loading.gif',
            }
        );

        let EditData = new FormData();
        let ErrorMessage = "";
        EditData.append('Action', 'Add');
        EditData.append('SubjectName', 'Category');

        let CategoryName = $('#AddCategoryName').val();

        if (CategoryName === "") ErrorMessage += "Vui lòng nhập tên danh mục.<br>";
        else EditData.append('CategoryName', CategoryName);

        if ($('#input-category-image')['0'].files.length !== 0)
        {
            EditData.append('NewsImage', $('#input-category-image')['0'].files[0]);
        } else ErrorMessage += "Vui lòng chọn ảnh bìa danh mục.<br>";

        if (ErrorMessage !== "")
        {
            Swal.fire
            (
                {
                    type: 'error',
                    title: 'Oops',
                    html: ErrorMessage,
                    showConfirmButton: true,
                }
            ); return;
        }

        await $.ajax
        (
            {
                type: 'POST',
                url: 'QGarden/AJAX.php',
                dataType: 'JSON',
                cache: false,
                contentType: false,
                processData: false,
                data: EditData,
                success: async function (Respond)
                {
                    if (Respond.StatusCode === 1)
                    {
                        Loading.close();

                        await Swal.fire
                        (
                            {
                                timer:1500,
                                type: 'success',
                                title: 'Thành Công',
                                text: 'Thêm Thành Công.',
                                showConfirmButton: false,
                                showCancelButton: false,
                            }
                        );
                        window.location.reload();
                    }
                    else
                    {
                        Loading.close();

                        Swal.fire
                        (
                            {
                                timer: 3000,
                                type: 'error',
                                title: 'Có lỗi xảy ra trong quá trình xử lý dữ liệu. Vui lòng thử lại sau.',
                                showConfirmButton: true,
                                showCancelButton: false,
                            }
                        );
                    }
                },
                error: function ()
                {
                    Loading.close();

                    Swal.fire
                    (
                        {
                            timer: 3000,
                            type: 'error',
                            title: 'Có lỗi xảy ra trong quá trình xử lý dữ liệu. Vui lòng thử lại sau.',
                            showConfirmButton: true,
                            showCancelButton: false,
                        }
                    );
                }
            }
        );
    });

    $('#AddBanner').click(function (Event)
    {
        Event.preventDefault();

        $(this).hide();

        $('form.hidden').show();
    });

    $('#DoAddBanner').click(async function (Event)
    {
        Event.preventDefault();

        let Loading = Swal.fire
        (
            {
                allowEscapeKey: false,
                title: 'Đang kiểm tra',
                allowOutsideClick: false,
                showConfirmButton: false,
                text: 'Vui lòng chờ trong giây lát...',
                imageUrl: '../Themes/Images/Default/Loading.gif',
            }
        );

        let AddBanner = new FormData();

        if ($('#input-category-image')['0'].files.length !== 0)
        {
            AddBanner.append('BannerImage', $('#input-category-image')['0'].files['0']);
            AddBanner.append('Action', 'AddBanner');
        }
        else
        {
            Swal.fire
            (
                {
                    type: 'error',
                    title: 'Oops',
                    text: 'Vui lòng chọn ảnh Banner.',
                    showConfirmButton: true,
                }
            ); return;
        }

        await $.ajax
        (
            {
                type: 'POST',
                url: 'QGarden/AJAX.php',
                dataType: 'JSON',
                cache: false,
                contentType: false,
                processData: false,
                data: AddBanner,
                success: async function (Respond)
                {
                    if (Respond.StatusCode === 1)
                    {
                        Loading.close();

                        await Swal.fire
                        (
                            {
                                timer:1500,
                                type: 'success',
                                title: 'Thành Công',
                                text: 'Thêm Thành Công.',
                                showConfirmButton: false,
                                showCancelButton: false,
                            }
                        );
                        window.location.reload();
                    }
                    else
                    {
                        Loading.close();

                        Swal.fire
                        (
                            {
                                timer: 3000,
                                type: 'error',
                                title: 'Có lỗi xảy ra trong quá trình xử lý dữ liệu. Vui lòng thử lại sau.',
                                showConfirmButton: true,
                                showCancelButton: false,
                            }
                        );
                    }
                },
                error: function ()
                {
                    Loading.close();

                    Swal.fire
                    (
                        {
                            timer: 3000,
                            type: 'error',
                            title: 'Có lỗi xảy ra trong quá trình xử lý dữ liệu. Vui lòng thử lại sau.',
                            showConfirmButton: true,
                            showCancelButton: false,
                        }
                    );
                }
            }
        );
    });

};