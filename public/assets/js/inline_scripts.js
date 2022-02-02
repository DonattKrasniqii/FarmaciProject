$('.paymentEditBtn').click(function () {
    var id = $(this).attr('data-id');
   if(typeof id !="undefined"){
       if(parseInt(id)>0){
           $.ajax({
               type: "GET",
               url: '/dashboard/payments/get-payment-informations',
               data: {id: id, _token: $('meta[name="csrf-token"]').attr('content')},
               success: function (data) {
                   if (data.success) {
                       console.log(data.payment);
                       $('#editModal #id').val(data.payment.id);
                       $('#editModal #user').val(data.payment.user_id).change();
                       $('#editModal #type').val(data.payment.type).change();
                       $('#editModal #from').val(data.payment.from);
                       $('#editModal #to').val(data.payment.to);
                       $('#editModal #note').val(data.payment.note);
                       $('#editModal #sum').val(data.payment.sum);
                       $('#editModal').show();


                   }
               },
           });
       }
   }
});

$('#closePaymentEditModal').click(function (){
    $('#editModal').hide();
});

var editor = new Jodit('#blogForm #description');



