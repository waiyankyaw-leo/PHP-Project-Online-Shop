$(document).ready(function(){

	cartNoti();
	showItem();
	showTotal();
	$('.addtocartBtn').on('click', function(){
		var id = $(this).data('id');
		var name = $(this).data('name');
		var price = $(this).data('price');
		var discount = $(this).data('discount');
		var photo = $(this).data('photo');
		var codeno = $(this).data('codeno');
		var qty = 1;

		var mylist ={
			id:id, 
			name:name,
			codeno:codeno,
			qty:qty, 
			price:price, 
			discount:discount,
			photo:photo
		}
        
        console.log(mylist);
		var cart = localStorage.getItem('cart');
		var cartArray;

		if (cart == null) {
			cartArray = Array();
		}else{
			cartArray = JSON.parse(cart);
		}

		var status = false;


		$.each(cartArray, function(i,v){
			if (id == v.id) {
				v.qty++;
				status = true;
			}
		})


		if (!status) {
			cartArray.push(mylist);
		}



		var cartData = JSON.stringify(cartArray);
		localStorage.setItem('cart',cartData);

		cartNoti();

	});

	function cartNoti(){
		var cart = localStorage.getItem('cart');

		if (cart) {
			var cartArray = JSON.parse(cart);

			var totalAmount=0;
			var notiCount=0;

			$.each(cartArray, function(i,v){
				var unitprice = v.price;
				var discount = v.discount;
				var qty = v.qty;

				if (discount) {
					var price = (unitprice-discount) * qty;
				}else{
					var price = unitprice * qty;
				}

				totalAmount += price++;
				notiCount += qty++;
			})

			$('.cartNoti').html(notiCount);
			$('.cartAmount').html(totalAmount+' Ks');

		}

		else{

			$('.cartNoti').html(0);
			$('.cartAmount').html(0+' Ks');

		}
	}

	function showItem(){
      var cartlist=localStorage.getItem("cart");
      if(cartlist)
      {
        var tmp="";
        var itemArray=JSON.parse(cartlist);
        var j=1;
        var temp=0;
        $.each(itemArray,function(i,v){

          tmp+=`<tr>
					<td>
						<button class="btn btn-outline-danger remove btn-sm" id="delete"
						data-id=${i} style="border-radius: 50%"> 
									<i class="icofont-close-line"></i> 
						</button> 
							</td>
							<td> 
								<img src="${v.photo}" class="cartImg">						
							</td>
							<td> 
								<p> ${v.name} </p>
								<p> ${v.codeno}</p>
							</td>
							<td>
								<button class="btn btn-outline-secondary plus_btn" id="btnincrease" data-id=${i}> 
									<i class="icofont-plus"></i> 
								</button>
							</td>
							<td>
								<p> ${v.qty} </p>
							</td>
							<td>
								<button class="btn btn-outline-secondary minus_btn" id="btndecrease" data-id=${i}> 
									<i class="icofont-minus"></i>
								</button>
							</td>
							<td>
								<p class="text-danger"> 
									${v.price-v.discount} Ks
								</p>
								<p class="font-weight-lighter"> 
								<del> ${v.price}Ks </del> </p>
							</td>
							<td>
								${(v.price-v.discount)*v.qty} Ks
							</td>
						</tr>`
      })

        $("#shoppingcart_table").html(tmp);
      }
    }

    $("#shoppingcart_table").on('click','#delete',function(){
         var id=$(this).data("id");
         var cartList=localStorage.getItem("cart");
         var cartArr=JSON.parse(cartList);
         cartArr.splice(id,1);
         var stringCart=JSON.stringify(cartArr);
         localStorage.setItem("cart",stringCart);
         showItem();
         cartNoti();
         showTotal();
         
      })

    $("#shoppingcart_table").on('click','#btndecrease',function(){
        var id=$(this).data("id");
        //console.log(id);
        var cartList=localStorage.getItem("cart");
        if(cartList){
          var  cartArray=JSON.parse(cartList);
          $.each(cartArray,function(i,v){
                  if(i==id){
                    v.qty--;
                    if(v.qty==0){
                      cartArray.splice(id,1);
                    }
                  }
                })
          var cartString=JSON.stringify(cartArray);
          localStorage.setItem("cart",cartString);
          cartNoti();
          showItem();
          showTotal();
        }
      })
    
    $("#shoppingcart_table").on('click','#btnincrease',function(){
        var id=$(this).data("id");
        console.log(id);
        var cartList=localStorage.getItem("cart");
        if(cartList){
          var  cartArray=JSON.parse(cartList);
          $.each(cartArray,function(i,v){
                  if(i==id){
                    v.qty++;
                    if(v.qty==0){
                      cartArray.splice(id,1);
                    }
                  }
                })
          var cartString=JSON.stringify(cartArray);
          localStorage.setItem("cart",cartString);
          cartNoti();
          showItem();
          showTotal();
        }
      })

 	function showTotal(){
      	var cartlist=localStorage.getItem("cart");
      	var total=0;
      	if(cartlist){
      		
      		var cartArray=JSON.parse(cartlist);
      		$.each(cartArray,function(i,v){

      		total += (v.price-v.discount)*v.qty;	
      		})
      		
      		var tmp=`TOTAL: ${total}`;
      		$('#total').html(tmp);
      	}
      }

});