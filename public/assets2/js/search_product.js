// $(document).ready(function () {
//
//
//     $('#search_button').on('submit', function (s) {
//         console.log('ok');
//         s.preventDefault();
//         $.ajaxSetup({
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             }
//         });
//         $.ajax({
//             type: 'post',
//             url: '/productSearch',
//             data: {
//                 '_token': $('input[name=_token]').val(),
//                 'product_search1': $("#product_search").val(),
//
//                 // 'to1':$("#to").val()
//             },
//             success: function (data) {
//                 console.log(data);
//
//                 $("#product_table tbody").html(data); //Replace contents of <tbody> tag
//
//                 $.each(data, function (i, d) {
//                     var $tr = $('<tr>').append(
//                         $('<td>').append( '<img src="upload/'+d.image+'" alt="image" >'),
//                         $('<td>').text(d.title),
//                         $('<td>').text(d.price),
//                         $('<td>').text(d.qty),
//                         $('<td>').text(d.price*d.qty)
//
//
//                     ).
//                     appendTo('#product_table');
//
//                 });
//
//                 // $.each(data, function (i, d) {
//                 //      $('#subTotal').append(
//                 //
//                 //         $('<li>').text(d.price).(),
//                 //         $('<li>').text(d.qty),
//                 //         $('<li>').text(15),
//                 //         $('<li>').text(d.price*.15)
//                 //
//                 //
//                 //     ).
//                 //     appendTo('#subTotal');
//                 //
//                 // });
//             }
//         });
//     });
//
//
//
//
// });