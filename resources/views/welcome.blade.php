<!DOCTYPE html>
<html>
    <head>
        <title>Todos</title>
        <link href="//cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.css" rel="stylesheet">
        <script src="//cdn.bootcss.com/vue/1.0.28/vue.js"></script>
        <script src="//cdn.bootcss.com/vue-resource/0.6.1/vue-resource.js"></script>
        <meta id="token" name="token" value="{{ csrf_token() }}">
    </head>
    <body>
        <div class="container">
            <div class="content">
                <task></task>
            </div>
        </div>

        <template id="task-template">
            <h1 class="title">My Totos</h1>
            <form>
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control" v-model="notes">
                        <div class="btn input-group-addon" @click="createTask">Submit</div>
                    </div>
                </div>
            </form>
            <ul class="list-group">
                <li class="list-group-item" v-for="task in tasks | orderBy 'id' -1">
                    @{{ task.body }}
                    <a class="btn btn-danger btn-xs" @click="deleteTask(task)">X</a>
                </li>
            </ul>
        </template>
    </body>

    <script>
        Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');

        var resource = Vue.resource('api/tasks/{id}');
        Vue.component('task', {
            template: '#task-template',
            data: function () {
                return {
                    notes: '',
                    tasks: []
                }
            },
            created: function () {
                this.$http.get('api/tasks').then(function (response) {
                    this.tasks = response.data;
                });
            },
            methods: {
                createTask: function () {
                    this.$http.post('api/tasks', {body: this.notes}).then(function (response) {
                        this.tasks.push(response.data.task);
                        this.notes = '';
                    });
                },
                deleteTask: function (task) {
                    resource.delete({id: task.id});
                    this.tasks.$remove(task);
                }
            }
        });

        new Vue({
            el: 'body'
        });
    </script>
</html>
