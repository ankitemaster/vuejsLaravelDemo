<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        <form action="#" @submit.prevent="submit">
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Email Address</label>
                                <div class="col-md-6">
                                    <input v-model="form.email" id="email" type="email" class="form-control" name="email"  required autocomplete="email" autofocus>
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ error_msg }}</strong>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-6">
                                    <input v-model="form.password" id="password" type="password" class="form-control" name="password" required autocomplete="current-password">
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ error_msg }}</strong>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Login
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

  export default {
    data() {
      return {
        error_msg: "",
        form: {
          email: '',
          password: '',
        }
      }
    },
    methods: {
        async submit() {
            axios.get('http://localhost:8000/sanctum/csrf-cookie').then(response => {
                axios.post('/login', this.form).then(response1 => {
                    this.$store.dispatch('setUserData',response1.data.data[0]);
                    if (!response1.data.status) {
                        this.error_msg = res.data.message
                        return
                    }
                    location.href = 'admin/dashboard';
                }).catch(error => {
                    this.error_msg = error
                });
            });
        }
    }
  }
</script>

