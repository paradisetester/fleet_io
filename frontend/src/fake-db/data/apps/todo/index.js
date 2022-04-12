import mock from '@/fake-db/mock.js'

// Contact
const data = {
  tasks: [
    {
      'id': 10,
      'title': 'Explain medical insurance',
      'desc': 'Health insurance covers cost of an insured individual\'s medical and surgical expenses.',
      'isImportant': true,
      'isStarred': false,
      'tags': ['activity'],
      'isCompleted': false,
      'isTrashed': false
    },
    {
      'id': 11,
      'title': 'Life insurance',
      'desc': 'What\'s the average cost of life insurance? A healthy person aged between 18 and 70 can expect to pay an average of $67.88 a month for a $250,000 life insurance policy.',
      'isImportant': true,
      'isStarred': true,
      'tags': ['appointment'],
      'isCompleted': false,
      'isTrashed': false
    },
    {
      'id': 11,
      'title': 'Life insurance',
      'desc': 'What\'s the average cost of life insurance? A healthy person aged between 18 and 70 can expect to pay an average of $67.88 a month for a $250,000 life insurance policy.',
      'isImportant': true,
      'isStarred': true,
      'tags': ['follow-up'],
      'isCompleted': false,
      'isTrashed': false
    }
  ],
  taskTags: [
    {
      id: 5,
      text: 'Activity',
      value : 'activity',
      color: 'primary'
    },
    {
      id: 7,
      text: 'Appointment',
      value: 'appointment',
      color: 'warning'
    },
    {
      id: 8,
      text: 'Follow Up',
      value: 'follow-up',
      color: 'success'
    }
  ]
}

// POST : Add new Tasks
mock.onPost('/api/apps/todo/tasks/').reply((request) => {

  // Get task from post data
  const task = JSON.parse(request.data).task

  const length = data.tasks.length
  let lastIndex = 0
  if (length) {
    lastIndex = data.tasks[length - 1].id
  }
  task.id = lastIndex + 1

  data.tasks.push(task)

  return [201, {id: task.id}]
})

// GET: Fetch Todos
mock.onGet('api/apps/todo/tasks').reply((request) => {

  const filter = request.params.filter

  const filteredTasks = data.tasks.filter((task) => {

    // If filter == all
    if (filter === 'all') return !task.isTrashed

    // If filter == starred
    if (filter === 'starred') return !task.isTrashed && task.isStarred

    // If filter == important
    if (filter === 'important') return !task.isTrashed && task.isImportant

    // If filter == completed
    if (filter === 'completed') return !task.isTrashed && task.isCompleted

    // If filter == trashed
    if (filter === 'trashed') return task.isTrashed

    else return task.tags.includes(filter)

  })


  return [200, JSON.parse(JSON.stringify(filteredTasks)).reverse()]
})

// GET: Fetch tags
mock.onGet('api/apps/todo/tags').reply(() => {
  return [200, JSON.parse(JSON.stringify(data.taskTags))]
})

// POST: Update Task
mock.onPost(/\/api\/apps\/todo\/task\/\d+/).reply((request) => {

  const taskId = request.url.substring(request.url.lastIndexOf('/') + 1)

  const task = data.tasks.find((task) => task.id == taskId)
  // task.title = JSON.parse(request.data).task.title
  Object.assign(task, JSON.parse(request.data).task)

  return [200, task]
})
