// const { Toast } = require("bootstrap");purchaseCalculate
// const { pad } = require("lodash"); totalSummingAmount totalCampingAmount getRoom

$(document).ready(function() {

    $(".delete_form").click(function() {
        var id = $(this).attr('rel');

        var record = $(this).attr('record');
        // alert(id);addCustomer
        swal({
                title: "Are you sure?",
                text: "You will not able to recover this record again!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, delete it",
            },
            function() {
                window.location.href = "delete-" + record + "/" + id;
            }
        );
    });

});

$(document).ready(function() {
    $(".categories").on('click', function() {
        var category_id = $(this).attr("category_id");
        console.log(category_id)
            // alert(category_id)
        $.ajax({
            type: 'get',
            url: '/admin/ajax-get-item',
            data: {
                category_id: category_id
            },
            success: function(response) {
                // console.log(response)
                $("#ajaxItem").html(response);
            },
            error: function() {
                alert("Error");
            }
        });
    });

});


function getRoom(room_id) {
    // alert(room_id)
    // $(".test").removeClass("metting-room-active");
    // $(`#metting-room-active-${room_id}`).addClass("test metting-room-active"); getTable

    $("#ajaxTableBigRoom").css("display", "none");

    if ($(`#metting-room-active-${room_id}`).hasClass('metting-room-active')) {
        $("#room_id").val('')
        $(".test").removeClass("metting-room-active");
        $("#tableRoomShow").css("display", "inline-block");
        $("#ajaxtTableShow").css("display", "none");
        return;

    } else {
        $(".test").removeClass("metting-room-active");
        $(`#metting-room-active-${room_id}`).addClass("test metting-room-active");
    }

    $("#room_id").val(room_id)
    $("#table_id").val("")
    $(".room-class").removeClass("active");
    $(`#room-${room_id}`).addClass("room-class active");

    $.ajax({
        type: 'get',
        url: '/admin/ajax-get-room-table',
        data: {
            room_id: room_id
        },
        success: function(response) {
            // console.log(response)
            if (response.data == 0) {} else {
                $("#tableRoomShow").css("display", "none");
                $("#ajaxTableRoom").empty();
                $("#ajaxTableRoom").html(response);
                // console.log('tst')
            }
        },
        error: function() {
            alert("Error");
        }
    });
}

function getSingleTable(table_id) {
    // alert(table_id);
    $("#table_id").val(table_id)
    $(".room-class").removeClass("active");
    $(`#table-${table_id}`).addClass("room-class active");
    return;
    $.ajax({
        type: 'get',
        url: '/admin/ajax-get-big-room-table',
        data: {
            table_id: table_id
        },
        success: function(response) {
            $("#ajaxTableBigRoom").css("display", "block");
            $("#ajaxTableBigRoom").html(response);
        },
        error: function() {
            alert("Error");
        }
    });

}

function ajaxTable(table_id) {
    // alert(table_id);
    $(".room-class").removeClass("active");
    $(`#table-${table_id}`).addClass("room-class active");
    $(`#table_ids`).val(table_id);
    return;
    $.ajax({
        type: 'get',
        url: '/admin/ajax-table',
        data: {
            table_id: table_id
        },
        success: function(response) {
            // $("#ajaxTableBigRoom").css("display", "block");
            $("#ajaxTable").html(response);
        },
        error: function() {
            alert("Error");
        }
    });

}

function getFoodType(item_type) {
    // console.log(item_type)
    $.ajax({
        type: 'get',
        url: '/admin/ajax-get-item-type',
        data: {
            item_type: item_type
        },
        success: function(response) {

            // console.log(response)
            $("#ajaxItem").html(response);
        },
        error: function() {
            alert("Error");
        }
    });
}

function addFood(item_id, price, name, is_bar, is_caffe, is_kitchen) {
    // console.log(item_id, price, name, is_bar, is_caffe, is_kitchen) quantityMinus
    $.ajax({
        type: 'post',
        url: '/admin/ajax-food-table',
        data: {
            item_id: item_id,
            price: price,
            name: name,
            is_bar: is_bar,
            is_caffe: is_caffe,
            is_kitchen: is_kitchen,

        },
        success: function(response) {
            // console.log(response)
            $("#add_item_table").html(response);
        },
        error: function() {
            alert("Error");
        }
    });
}
// delet food cart item 
function deleteCartItem(cart_id) {
    $.ajax({
        type: 'post',
        url: '/admin/delete-cart-item',
        data: {
            cart_id: cart_id,
        },
        success: function(response) {
            // alert(response)
            $('#add_item_table').html(response.view);
        },
        error: function() {
            alert("Error");
        }
    });
}

function qtyMinus(cart_id) {
    var qty = "qtyMinus"
    console.log(cart_id)
        // alert(qty)
    $.ajax({
        type: 'post',
        url: '/admin/update-cart-item-quantity',
        data: {
            cart_id: cart_id,
            qty: qty,
        },
        success: function(response) {
            // alert(response)
            $('#add_item_table').html(response.view);
        },
        error: function() {
            alert("Error");
        }
    });
}

function qtyPlus(cart_id) {
    var qty = "qtyPlus"
    console.log(cart_id)
    $.ajax({
        type: 'post',
        url: '/admin/update-cart-item-quantity',
        data: {
            cart_id: cart_id,
            qty: qty,
        },
        success: function(response) {
            // alert(response)
            $('#add_item_table').html(response.view);
        },
        error: function() {
            alert("Error");
        }
    });
}




// delet food cart item 
function deleteCartItem(cart_id) {
    $.ajax({
        type: 'post',
        url: '/admin/delete-cart-item',
        data: {
            cart_id: cart_id,
        },
        success: function(response) {
            // alert(response)
            $('#add_item_table').html(response.view);
        },
        error: function() {
            alert("Error");
        }
    });
}

function discountFunction(e) {
    var total = $("#sub_total").val();
    var discount = e.value;
    var grand_total = (total - discount)
    $("#grand_total").val(grand_total)
    $("#total_amount").text(grand_total)
}

function quantityMinus(cart_id) {
    // alert(cart_id)
    // return;
    var qty = "qtyMinus"
    var order_id = $("#order_id").val()
    $.ajax({
        type: 'post',
        url: '/admin/update-order-item-quantity',
        data: {
            cart_id: cart_id,
            order_id: order_id,
            qty: qty,

        },
        success: function(response) {
            // alert(response)
            // console.log(response)
            $('#ajaxModifyOrder').html(response);
        },
        error: function() {
            alert("Error");
        }
    });
}

function quantityPlus(cart_id) {
    var qty = "qtyPlus"
    var order_id = $("#order_id").val()
    $.ajax({
        type: 'post',
        url: '/admin/update-order-item-quantity',
        data: {
            cart_id: cart_id,
            order_id: order_id,
            qty: qty,


        },
        success: function(response) {
            // alert(response)
            $('#ajaxModifyOrder').html(response);
        },
        error: function() {
            alert("Error");
        }
    });
}

function deleteOrderDetail(cart_id) {
    var order_id = $("#order_id").val()
    $.ajax({
        type: 'post',
        url: '/admin/delete-order-item-quantity',
        data: {
            cart_id: cart_id,
            order_id: order_id,
        },
        success: function(response) {
            // alert(response)
            $('#ajaxModifyOrder').html(response);
        },
        error: function() {
            alert("Error");
        }
    });
}

function addCustomer(table_id) {
    // alert('test')

    var no_customer = $(`#no_of_customer-${table_id}`).val()
    var type = $(`#type-${table_id}`).val()

    // alert(no_customer)
    // console.log(table_id, no_customer)
    $.ajax({
        type: 'post',
        url: '/admin/ajax-add-customer',
        data: {
            table_id: table_id,
            no_customer: no_customer,
            type: type,
        },
        success: function(response) {
            // console.log(response)
            if (response.count == 1) {
                $(`#data-${response.table_ids}`).empty();
                $(`#table_id`).val(response.table_ids);
                $(`#table_ids`).val(response.table_ids);
                $(`#total-customer-${response.table_ids}`).text(response.no_customer);
                if (response.available_seat >= 1) {
                    $(`#no_of_customer-${response.table_ids}`).css("display", "flex");
                    $(`#type-${response.table_ids}`).css("display", "flex");
                    $(`#display-btn-${response.table_ids}`).css("display", "flex");
                    $(`#display-${response.table_ids}`).css("display", "none");
                } else {
                    $(`#display-${response.table_ids}`).css("display", "block");
                    $(`#no_of_customer-${response.table_ids}`).css("display", "none");
                    $(`#type-${response.table_ids}`).css("display", "none");
                    $(`#display-btn-${response.table_ids}`).css("display", "none");
                }
                response.data.forEach(element => {
                    $(`#data-${response.table_ids}`).append(
                        `<tr> <td>${element.no_customer}</td>
                         <td>${element.type}</td>
                        <td><a href="javascript:" onclick="deleteCustomerTable(${element.id}, ${response.table_ids})"  ><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                        </tr>`
                    )
                });
                $(`#available_seat-${response.table_ids}`).text(`Avaliable : ${response.available_seat}`)

            } else {
                alert('Seat is no available !')
            }


        },
        error: function() {
            alert("Error");
        }
    });
    // console.log(cart_id, no_customer)
}

// delete customer table 
function deleteCustomerTable(customer_id, table_id) {
    // alert(id)
    $.ajax({
        type: 'post',
        url: '/admin/ajax-delete-customer-table',
        data: {
            customer_id: customer_id,
            table_id: table_id,
        },
        success: function(response) {
            console.log(response)
                // alert(response.no_customer)
            $(`#data-${response.table_ids}`).empty();
            $(`#table_id`).val(response.table_ids);
            $(`#total-customer-${response.table_ids}`).text(response.no_customer);
            if (response.available_seat >= 1) {
                $(`#no_of_customer-${response.table_ids}`).css("display", "flex");
                $(`#type-${response.table_ids}`).css("display", "flex");
                $(`#display-btn-${response.table_ids}`).css("display", "flex");
                $(`#display-${response.table_ids}`).css("display", "none");
            } else {
                $(`#display-${response.table_ids}`).css("display", "block");
                $(`#no_of_customer-${response.table_ids}`).css("display", "none");
                $(`#type-${response.table_ids}`).css("display", "none");
                $(`#display-btn-${response.table_ids}`).css("display", "none");
            }

            response.data.forEach(element => {
                $(`#data-${response.table_ids}`).append(
                    `<tr> <td>${element.no_customer}</td>
                    <td>${element.type}</td>
                    <td><a href="javascript:" onclick="deleteCustomerTable(${element.id}, ${response.table_ids})"  ><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                    </tr>`
                )
            });
            $(`#available_seat-${response.table_ids}`).text(`Avaliable : ${response.available_seat}`)
        },
        error: function() {
            alert("Error");
        }
    });
}

//kishor i did this
$(document).ready(function() {

    $("#search-field").keyup(function() {
        var searchItem = $(this).val();
        $.ajax({
            type: 'post',
            url: '/admin/ajax-search-food',
            data: {
                searchItem: searchItem,

            },
            success: function(response) {
                // console.log(response)
                $("#ajaxItem").html(response);
            },
            error: function() {
                alert("Error");
            }
        });

    })


    $(".order_item").click(function() {
        var order_id = $(this).attr('order_id')
        $(".oder-active").removeClass('active');
        $(`#orders-${order_id}`).addClass("oder-active active");
        $("#order_id").val(order_id);
        $("#orders_id").val(order_id);

    })
    $(".modify_order").click(function() {
        var order_id = $("#order_id").val()
            // alert(order_id)
        if (order_id != "") {
            $.ajax({
                type: 'get',
                url: '/admin/ajax-get-modify-order',
                data: {
                    order_id: order_id,
                },
                success: function(response) {
                    // console.table(response)
                    // alert(response)
                    $('#ajaxModifyOrder').html(response);
                },
                error: function() {
                    alert("Error");
                }
            });
        } else {
            alert('Please Select Order');
        }
    })
    $(".test_order_details").click(function() {
        var order_id = $("#order_id").val()
        if (order_id != "") {

            $.ajax({
                type: 'get',
                url: '/admin/ajax-order-details',
                data: {
                    order_id: order_id,
                },
                success: function(response) {
                    console.log(response)
                        // alert(response)
                    $('#ajaxOrderDetail').html(response);
                },
                error: function() {
                    alert("Error");
                }
            });
        } else {
            alert('Please Select Order');
        }
    })
    $(".kot_order_details").click(function() {
        var order_id = $("#order_id").val()
            // alert(order_id)
        if (order_id != "") {

            $.ajax({
                type: 'get',
                url: '/admin/ajax-kit-order-details',
                data: {
                    order_id: order_id,
                },
                success: function(response) {
                    console.log(response)
                        // alert(response)
                    $('#ajaxKotOrderDetail').html(response);
                },
                error: function() {
                    alert("Error");
                }
            });
        } else {
            alert('Please Select Order');
        }
    })
    $(".bot_order_details").click(function() {
        var order_id = $("#order_id").val()
        if (order_id != "") {

            // alert(order_id)
            $.ajax({
                type: 'get',
                url: '/admin/ajax-bot-order-details',
                data: {
                    order_id: order_id,
                },
                success: function(response) {
                    console.log(response)
                        // alert(response)
                    $('#ajaxBotOrderDetail').html(response);
                },
                error: function() {
                    alert("Error");
                }
            });
        } else {
            alert('Please Select Order');
        }
    })
    $(".order_innovice").click(function() {
        var order_id = $("#order_id").val()
        if (order_id != "") {

            $.ajax({
                type: 'get',
                url: '/admin/oder-innovice',
                data: {
                    order_id: order_id,
                },
                success: function(response) {
                    console.log(response)
                        // alert(response)
                    $('#checkout').html(response);
                },
                error: function() {
                    alert("Error");
                }
            });
        } else {
            alert('Please Select Order');
        }
    })
    $(".order_bill").click(function() {
        var order_id = $("#order_id").val()
        console.log(order_id)
        if (order_id != "") {

            $.ajax({
                type: 'get',
                url: '/admin/oder-bill',
                data: {
                    order_id: order_id,
                },
                success: function(response) {
                    console.log(response)
                    $('#oder-bill').html(response);
                },
                error: function() {
                    alert("Error");
                }
            });
        } else {
            alert('Please Select Order');
        }
    })
    $(".kitchen_status").click(function() {
        var order_id = $("#order_id").val()
        if (order_id != "") {

            $.ajax({
                type: 'get',
                url: '/admin/kitchen-status',
                data: {
                    order_id: order_id,
                },
                success: function(response) {
                    console.log(response)
                        // alert(response)
                    $('#ajaxKitchenStatus').html(response);
                },
                error: function() {
                    alert("Error");
                }
            });
        } else {
            alert('Please Select Order');
        }
    })
    $(".update-oder").click(function() {
        alert('tets')
    })
    $(".will_login").click(function() {
        var value = $(this).val();
        if (value == 'Yes') {
            $(".add_user").css("display", 'block');

        } else {
            $(".add_user").css("display", 'none');

        }

        // alert(value)
    })
    $(".checkAll").click(function() {
        if (!$('input:checkbox.country').is('checked')) {
            // alert("test")

            $('input:checkbox').attr('checked', 'checked');
        } else {
            alert('test');
            $('input:checkbox').removeAttr('checked');
        }

    });

    // function checkAll() { totalCheckoutBillAmount
    //     // alert('tst')
    //     if (!$('input:checkbox').is('checked')) {
    //         a
    //         $('input:checkbox').attr('checked', 'checked');
    //     } else {
    //         alert('test');
    //         $('input:checkbox').removeAttr('checked');
    //     }
    // }


});

$(document).ready(function() {
    $("#purchase_id").change(function() {
        var purchase_id = $("#purchase_id").val();

        // alert(purchase_id) addFood
        $.ajax({
            type: 'post',
            url: '/admin/ajax-purchase-table',
            data: {
                purchase_id: purchase_id
            },
            success: function(response) {
                console.log(response)
                if (response.message == "exsist") {
                    alert('Item already exsist!')
                } else {
                    $("#ajaxPurchase").html(response);

                }
            },
            error: function() {
                alert("Error");
            }
        });
    });

});
//Delete purchase cart  purchase_id
function deletePurchaseCart(ingredient_id) {
    // alert(ingredient_id)
    $.ajax({
        type: 'post',
        url: '/admin/delete-purchase-table',
        data: {
            ingredient_id: ingredient_id
        },
        success: function(response) {
            console.log(response)
            $("#ajaxPurchase").html(response);

        },
        error: function() {
            alert("Error");
        }
    });
}

function purchaseCalculate(ingredientCart_id) {
    // var quantity = e.value;

    // alert(ingredientCart_id);
    var price = $(`#ingredient_unit_price-${ingredientCart_id}`).val()
    var quantity = $(`#ingredient_quantity-${ingredientCart_id}`).val();

    console.log(ingredientCart_id, price, quantity);

    $.ajax({
        type: 'post',
        url: '/admin/check-current-amount',
        data: {
            ingredientCart_id: ingredientCart_id,
            price: price,
            quantity: quantity

        },
        success: function(response) {
            // console.log(response)
            $(`#subTotal-${response.ingredient_id}`).text(response.subtotal);
            $(`#total`).val(response.total);
            $(`#deu_amount`).val(response.total);
            $(`#subtotal`).val(response.total);

            // if (response.message == "exsist") {
            //     alert('Item already exsist!')
            // } else {
            //     $("#ajaxPurchase").html(response);
            // }

        },
        error: function() {
            alert("Error");
        }
    });
}

function totalCalculationPurchase() {
    // alert('test')
    var subtotal = $("#subtotal").val();
    var vat = $("#vat").val();
    var tax = $("#tax").val();

    // console.log(tax, vat, subtotal)
    if (subtotal == "") {
        subtotal = 0;
    }
    if (tax == "") {
        tax = 0;
    }
    if (vat == "") {
        vat = 0;
    }
    var total_tax = parseInt(subtotal) * parseInt(tax) / 100;
    var total_vat = parseInt(subtotal) * parseInt(vat) / 100;
    console.log(total_tax, total_vat)

    var total = parseInt(subtotal) + total_tax + total_vat
    console.log(total)
    $("#total").val(total);
    $("#deu_amount").val(total);



}

function purchasePaid(e) {
    var paid = e.value;
    var total = $(".total").val();
    //alert(total);
    //console.log(paid,total);
    var paidamount = total - paid;
    console.log(paidamount)
    $("#deu_amount").val(paidamount)
        // console.log(paidamount);
}
//ajx check current amount in ajx purchase table  
$(document).ready(function() {
    //check current amount
    $(".ingredientCart_id").change(function() {
        var ingredientCart_id = $(this).attr('ingredientCart_id');
        var quantity = $(this).val();
        // alert(ingredientCart_id);
        //console.log(chkCurrentAmount);

        $.ajax({
            type: 'post',
            url: '/admin/check-current-amount',
            data: {
                ingredientCart_id: ingredientCart_id,
                quantity: quantity
            },
            success: function(response) {
                console.log(response)
                $("#ajaxPurchase").html(response);

            },
            error: function() {
                alert("Error");
            }
        });
    });

    //ajax for paid amount

});


//ajax food table

$(document).ready(function() {
    $("#foodTable_id").change(function() {
        var foodTable_id = $("#foodTable_id").val();
        //_var consumption= $(this).attr("consumption");
        // alert(foodTable_id)
        $.ajax({
            type: 'post',
            url: '/admin/ajax-foodMenu-table',
            data: {
                foodTable_id: foodTable_id,
                //consumption : consumption,
            },
            success: function(response) {
                console.log(response)
                if (response.message == "exsist") {
                    alert('Item already exsist!')
                } else {
                    $("#ajaxFoodTable").html(response);
                }

            },
            error: function() {
                alert("Error");
            }
        });
    });

});

//ajax delete foodmenutable
function deleteFoodMenTable(ingredient_id) {
    // alert(ingredient_id)
    $.ajax({
        type: 'post',
        url: '/admin/delete-foodMenu-table',
        data: {
            ingredient_id: ingredient_id
        },
        success: function(response) {
            console.log(response)
            $("#ajaxFoodTable").html(response);

        },
        error: function() {
            alert("Error");
        }
    });
}
// checkAll
function electricityConsumption() {
    var electricity_uses = ($("#electricity_uses").val());
    var early_electricity_consumption = ($("#early_electricity_consumption").val());
    var electricity_unit = ($("#electricity_unit").val());
    var electricity_paid = ($("#electricity_paid").val());
    var electricity_last_month_due = parseInt($("#electricity_last_month_due").val());
    console.log(electricity_last_month_due)
        // if (!electricity_last_month_due == "NaN") {
        //     electricity_last_month_due = 0;
        // }

    // console.log(electricity_uses, early_electricity_consumption, electricity_unit, electricity_paid, electricity_last_month_due)
    // console.log(early_electricity_consumption, electricity_unit)
    if (early_electricity_consumption == null && !electricity_unit == "" && electricity_uses != "") {
        // console.log(early_electricity_consumption, electricity_uses, electricity_unit)

        var total = electricity_uses * electricity_unit;
        $("#electricity_total").val(total);
        var due = total - electricity_paid;
        $("#electricity_due").val(due);

    }
    if (!early_electricity_consumption == "" && !electricity_uses == "" && !electricity_unit == "") {

        var total_consumption = early_electricity_consumption - electricity_uses;
        console.log(total_consumption)
        if (electricity_last_month_due != "") {
            var total = (total_consumption * electricity_unit) + electricity_last_month_due;
            // console.log(total + 'duelastmonth')

        } else {
            var total = (total_consumption * electricity_unit);
            // console.log(total + "no due")
        }
        if (!electricity_paid == "") {
            var due = (total) - electricity_paid;

        } else {
            var due = (total);

        }
        // if (electricity_last_month_due != "" && electricity_paid >= electricity_last_month_due) {
        //     $("#electricity_last_month_due").val(0)
        // }

        $("#electricity_total").val(total);



        $("#electricity_due").val(due);

    }
}

function paymentType(type) {
    console.log(type)
    if (type == "single") {
        $("#single").css("display", "block");
        $("#start_date").css("display", "none");
        $("#end_date").css("display", "none");
    } else {
        $("#single").css("display", "none");
        $("#start_date").css("display", "block");
        $("#end_date").css("display", "block");
    }

}
$("#customer_name").change(function() {
    var customer_id = $(this).val();
    console.log(customer_id)
    $.ajax({
        type: 'get',
        url: `/admin/ajax-get-customer/${customer_id}`,
        data: {},
        success: function(response) {
            // console.table(response)
            // alert(response)
            $("#address").val(response.address)
            $("#contact").val(response.phone)

        },
        error: function() {
            alert("Error");
        }
    });
})
$("#room_type_id").change(function() {
    var room_id = $(this).val();
    console.log(room_id)
    $.ajax({
        type: 'get',
        url: `/admin/ajax-get-room/${room_id}`,
        data: {},
        success: function(response) {
            // console.table(response)
            // alert(response)
            $("#price").val(response.price)
            $("#room_type").val(response.room_type.room_type)

        },
        error: function() {
            alert("Error");
        }
    });
})

$("#travel_agent").change(function() {
    var agent = $(this).val()
    console.log(agent)
    if (agent == 'Agent') {
        $("#display_agent_name").css("display", "block");
    } else {
        $("#display_agent_name").css("display", "none");

    }

})
$(".totalAmountRoom").keyup(function() {
    var room_charge = ($("#room_charge").val())
    var advance = ($("#advance").val())
    var additional_charge = ($("#additional_charge").val())
    var discount = ($("#discount").val())
        // var paid = ($("#paid").val())
    console.log(room_charge, advance, additional_charge, discount)
    if (room_charge == "") {
        room_charge = 0;
    }
    if (additional_charge == "") {
        additional_charge = 0;
    }
    if (advance == "") {
        advance = 0;
    }
    if (discount == "") {
        discount = 0;
    }
    // if (paid == "") {
    //     paid = 0;
    // }


    var subTotal = parseInt(room_charge) + parseInt(additional_charge);
    var total = (parseInt(subTotal) - parseInt(advance)) - parseInt(discount);
    var due = total;

    $("#total").val(total)
    $("#due").val(due)





})
$(".totalAmountRoom").change(function() {
    var room_charge = ($("#room_charge").val())
    var advance = ($("#advance").val())
    var additional_charge = ($("#additional_charge").val())
    var discount = ($("#discount").val())
        // var paid = ($("#paid").val())
    console.log(room_charge, advance, additional_charge, discount)
    if (room_charge == "") {
        room_charge = 0;
    }
    if (additional_charge == "") {
        additional_charge = 0;
    }
    if (advance == "") {
        advance = 0;
    }
    if (discount == "") {
        discount = 0;
    }
    // if (paid == "") {
    //     paid = 0;
    // }


    var subTotal = parseInt(room_charge) + parseInt(additional_charge);
    var total = (parseInt(subTotal) - parseInt(advance)) - parseInt(discount);
    var due = total;

    $("#total").val(total)
    $("#due").val(due)





})


$(".totalSummingAmount").change(function() {

    var number_of_customer = ($("#number_of_customer").val())
        // alert(number_of_customer)
    var price = ($("#price").val())
    var duration = ($("#duration").val())
    var paid = ($("#paid").val())
    console.log(price, duration, paid)
    if (price == "") {
        price = 0;
    }
    if (duration == "") {
        duration = 0;
    }
    if (paid == "") {
        paid = 0;
    }
    if (number_of_customer == "") {
        number_of_customer = 0;
    }
    var total = (parseInt(price) * parseInt(duration) * parseInt(number_of_customer));
    var due = total - parseInt(paid);

    $("#total").val(total)
    $("#due").val(total)

})
$(".totalSummingAmount").keyup(function() {

    var number_of_customer = ($("#number_of_customer").val())
        // alert(number_of_customer)
    var price = ($("#price").val())
    var duration = ($("#duration").val())
    var paid = ($("#paid").val())
    console.log(price, duration, paid)
    if (price == "") {
        price = 0;
    }
    if (duration == "") {
        duration = 0;
    }
    if (paid == "") {
        paid = 0;
    }
    if (number_of_customer == "") {
        number_of_customer = 0;
    }
    var total = (parseInt(price) * parseInt(duration) * parseInt(number_of_customer));
    var due = total - parseInt(paid);

    $("#total").val(total)
    $("#due").val(total)

})
$("#tent_id").change(function() {
    // console.log($(this).val())
    var tent_id = $(this).val();
    $.ajax({
        type: 'post',
        url: `/admin/ajax-get-tent-price`,
        data: {
            tent_id: tent_id,
        },
        success: function(response) {
            console.table(response)
                // alert(response)
            $("#price").val(response)
                // $("#room_type").val(response.room_type.room_type)

        },
        error: function() {
            alert("Error");
        }
    });

})


$(".totalCampingAmount").keyup(function() {
    // alert('teseted')
    var number_of_customer = ($("#number_of_customer").val())
    var price = ($("#price").val())
    var duration = ($("#duration").val())
    console.log(price, duration)
    if (number_of_customer == "") {
        number_of_customer = 0;
    }
    if (price == "") {
        price = 0;
    }
    if (duration == "") {
        duration = 0;
    }
    var total = (parseInt(price) * parseInt(duration) * parseInt(number_of_customer));
    $("#total").val(total)
    $("#due").val(total)

})
$(".totalCampingAmount").click(function() {
    // alert('teseted')
    var number_of_customer = ($("#number_of_customer").val())
    var price = ($("#price").val())
    var duration = ($("#duration").val())
    console.log(price, duration)
    if (number_of_customer == "") {
        number_of_customer = 0;
    }
    if (price == "") {
        price = 0;
    }
    if (duration == "") {
        duration = 0;
    }
    var total = (parseInt(price) * parseInt(duration) * parseInt(number_of_customer));
    $("#total").val(total)
    $("#due").val(total)

})
$(".totalCheckoutBillAmount").change(function() {
    // alert('teseted') totalAmountRoom
    var service_charge = ($("#service_charge").val())
    var paid = ($("#paid").val())
    var discount = ($("#discount").val())
    var tax = ($("#tax").val())
    var vat = ($("#vat").val())
        // alert(vat)
    var subtotal = ($("#subtotal").val())
    if (service_charge == "") {
        service_charge = 0;
    }
    if (paid == "") {
        paid = 0;
    }
    if (discount == "") {
        discount = 0;
    }
    if (tax == "") {
        tax = 0;
    }
    if (vat == "") {
        vat = 0;
    }
    if (subtotal == "") {
        subtotal = 0;
    }
    console.log(subtotal, tax)

    var subtotal = (parseInt(subtotal) + parseInt(service_charge) - parseInt(discount));
    var vat = +(subtotal * vat / 100);
    var total = subtotal + vat + (subtotal * tax / 100);
    var due = total - parseInt(paid)
    $("#total").val(total)
    $("#due").val(due)

})
$(".totalCheckoutBillAmount").keyup(function() {
    // alert('teseted') totalCheckoutBillAmount
    var service_charge = ($("#service_charge").val())
    var paid = ($("#paid").val())
    var discount = ($("#discount").val())
    var tax = ($("#tax").val())
    var subtotal = ($("#subtotal").val())
    if (service_charge == "") {
        service_charge = 0;
    }
    if (paid == "") {
        paid = 0;
    }
    if (discount == "") {
        discount = 0;
    }
    if (tax == "") {
        tax = 0;
    }
    if (subtotal == "") {
        subtotal = 0;
    }
    console.log(subtotal, tax)

    var subtotal = (parseInt(subtotal) + parseInt(service_charge) - parseInt(discount));
    var total = subtotal + (subtotal * tax / 100);
    var due = total - parseInt(paid)
    $("#total").val(total)
    $("#due").val(due)

})

$("#deu_pay_amount").keyup(function() {
    var total = ($("#due_total").val())
    var paid = ($("#deu_pay_amount").val());
    if (paid == "") {
        paid = 0;
    }
    if (total == "") {
        total = 0;
    }
    var due = parseInt(total) - parseInt(paid);
    $("#deu_amount").val(due)
})
$("#deu_pay_amount").change(function() {
        var total = ($("#due_total").val())
        var paid = ($("#deu_pay_amount").val());
        if (paid == "") {
            paid = 0;
        }
        if (total == "") {
            total = 0;
        }
        var due = parseInt(total) - parseInt(paid);
        $("#deu_amount").val(due)
    })
    // purchaseCalculate


$(".getMonthlyProfitLoss").change(function() {
    var month = $("#get_month").val();
    $.ajax({
        type: 'get',
        url: `/admin/ajax-get-monthly-report`,
        data: {
            month: month
        },
        success: function(response) {
            // console.table(response)
            // alert(response)
            console.log(response);
            $("#ajaxProfitLoss").html(response.view)

        },
        error: function() {
            alert("Error");
        }
    });

    // alert(month)
})