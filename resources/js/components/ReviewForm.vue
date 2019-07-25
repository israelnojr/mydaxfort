<template>
    <div>
        <form @submit.prevent="postReview"
            class="row contact_form"
            id="contactForm"> 
            <div class="col-md-12">
                <div class="form-group">
                <input
                    type="hidden"
                    class="form-control"
                    id="product_id"
                    v-model="formData.product_id"
                    
                    placeholder="Product Id"
                />
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                 Select Star Rating: <star-rating star-size=20 increment=0.5 v-model="formData.rating" ></star-rating>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                <input
                    required
                    type="title"
                    class="form-control"
                    id="title"
                    v-model="formData.title"
                    placeholder="Give a header"
                />
                </div>
            </div>
            <div class="col-md-12">
                
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <textarea
                        required
                        class="form-control"
                        v-model="formData.review"
                        id="review"
                        rows="3"
                        placeholder="What do you have to say.....?">
                    </textarea>
                </div>
            </div>
            <div class="col-md-12 text-right">
                <button
                    type="submit"
                    value="submit"
                    class="btn submit_btn">
                    Submit Now 
                </button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
       props:['product'],
       data(){
           return{
               formData:{}
           }
       },

       methods:{
           postReview(){
               this.formData.product_id = this.product.id;
               
            //    axios.post(this.url, this.formData)
            axios.post('/review', this.formData)
                .then(data =>{
                    swal.fire(
                    'Updated!',
                    'Review Added successfully',
                    'success'
                    )  
                 location.reload();
                })
                .catch(error => {
                    console.log(error)
                })
            }

       }
    }
</script>
