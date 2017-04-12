<!DOCTYPE html>
<html>
<head>
    <meta chartset="utf-8">
    <title>Todo</title>
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="//cdn.bootcss.com/vue/2.2.6/vue.js"></script>
    <style>
        .completed {
            text-decoration: line-through;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome to Vue.js 2.0</div>
                <div class="panel-body">
                    <h1>@{{ title }}(@{{ todoCount }})</h1>
                    <form>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" v-model="task.body">
                                <div class="btn input-group-addon" @click="createTask(task)">Submit</div>
                            </div>
                        </div>
                    </form>
                    <ul class="list-group">
                        <li class="list-group-item" v-for="(todo, index) in todos" :class="{ completed: todo.completed }">
                            @{{ todo.body }}
                            <div class="btn btn-danger btn-xs" @click="deleteTask(index)">X</div>
                            <div class="btn btn-xs" @click="toggleComplete(todo)" :class="[todo.completed ? 'btn-danger' : 'btn-success']">@{{ todo.completed ? 'undo' : 'complete' }}</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script>
    new Vue({
        el: '.container',
        data: {
            title: 'My Todo',
            task: {body: '', completed: false},
            todos: [
                {body: 'learn javascript', completed: true},
                {body: 'learn PHP', completed: true},
                {body: 'learn MySQL', completed: true}
            ]
        },
        methods: {
            createTask (task) {
                this.todos.push(task);
                this.task = {body: '', completed: false};
            },
            deleteTask (index) {
                this.todos.splice(index, 1);
            },
            toggleComplete(todo) {
                todo.completed = !todo.completed;
            }
        },
        computed: {
            todoCount() {
                return this.todos.length;
            }
        }
    })
</script>
</html>