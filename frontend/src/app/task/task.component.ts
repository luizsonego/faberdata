import { HttpClient } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, NgForm } from '@angular/forms';


export class Task {
  constructor(
    public id: number,
    public title: string,
    public description: string,
    public status: number,
    public timelimit: string,
  ) { }
}

@Component({
  selector: 'app-task',
  templateUrl: './task.component.html',
  styleUrls: ['./task.component.css']
})
export class TaskComponent implements OnInit {

  tasks: Task[] | undefined;
  formEditTask: FormGroup | undefined;
  title: string | undefined;
  description: string | undefined;
  status: number | undefined;
  timelimit: string | undefined;
  isEditing: boolean = false;
  id: number | undefined;

  constructor(
    private formBuilder: FormBuilder,
    private httpClient: HttpClient,
  ) { }

  ngOnInit(): void {
    this.getTasks()

    this.formEditTask = this.formBuilder.group({
      id: [''],
      title: [''],
      description: [''],
      status: [''],
      timelimit: [''],
    })
  }

  getTasks() {
    this.httpClient.get<any>('http://localhost:8000/api/task/index.php').subscribe(
      response => {
        this.tasks = response.data
      }
    );
  }

  editTask(task: Task) {
    this.isEditing = true;
    this.id = task.id
    this.title = task.title
    this.description = task.description
    this.status = task.status
    this.timelimit = task.timelimit

  }

  deleteTask(task: Task) {
    console.log(task.id);
    const url = 'http://localhost:8000/api/task/delete.php';
    this.httpClient.post(url, { "id": task.id })
      .subscribe((result) => {
        this.ngOnInit();
      })
  }

  onSubmit(f: NgForm) {
    const url = this.isEditing ? 'http://localhost:8000/api/task/update.php' : 'http://localhost:8000/api/task/create.php';
    this.httpClient.post(url, f.value)
      .subscribe((result) => {
        this.ngOnInit();
      })
  }
}
