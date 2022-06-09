$(document).ready(function () {
  $('#quickForm').validate({
    rules: {
      email: {
        required: true,
        email: true,
      },
      password: {
        required: true,
        minlength: 5
      },
      terms: {
        required: true
      },
    },
    messages: {
      email: {
        required: "Please enter a email address",
        email: "Please enter a vaild email address"
      },
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
    $('#quickForms').validate({
    rules: {
      email: {
        required: true,
        email: true,
      },
      password: {
        required: true,
        minlength: 5
      },
      terms: {
        required: true
      },
    },
    messages: {
      email: {
        required: "Please enter a email address",
        email: "Please enter a vaild email address"
      },
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
 
  
  
  $('#admin_add_validation').validate({
    rules: {
      name :{
        require: true,
        minlength:5,
      } ,
      email: {
        required: true,
        email: true,
      },
      number:{
        required:true,
        minlength:10,
      },
      type:{
        required:true,
      },
      password: {
        required: true,
        minlength: 5
      },
      terms: {
        required: true
      },
    },
    messages: {
      name:{
        required: "Name feild is required!",
        minlength: "Name must be a lest 3 letters!"
      },
      email: {
        required: "Email feild is required!",
        email: "Please enter a vaild email address!"
      },
      number: {
        required: "Number feild is required!",
        minlength: "Enter at lest 10 number!"
      },
      type: {
        required: "Email feild is required!",
      },
      password: {
        required: "Password field is required!",
        minlength: "Your password must be at least 5 characters long!"
      },
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
  $('#admin_edit_validation').validate({
    rules: {
      name :{
        require: true,
        minlength:5,
      } ,
      email: {
        required: true,
        email: true,
      },
      number:{
        required:true,
        minlength:10,
      },
      type:{
        required:true,
      },
      password: {
        required: true,
        minlength: 5
      },
      terms: {
        required: true
      },
    },
    messages: {
      name:{
        required: "Name feild is required!",
        minlength: "Name must be a lest 3 letters!"
      },
      email: {
        required: "Email feild is required!",
        email: "Please enter a vaild email address!"
      },
      number: {
        required: "Number feild is required!",
        minlength: "Enter at lest 10 number!"
      },
      type: {
        required: "Email feild is required!",
      },
      password: {
        required: "Password field is required!",
        minlength: "Your password must be at least 5 characters long!"
      },
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
  $("#admin_edit_validation").onClick(function(){
    alert('test')
  })
});