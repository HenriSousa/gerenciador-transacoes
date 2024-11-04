import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { TransacaoListComponent } from './components/transacao-list/transacao-list.component';
import { TransacaoFormComponent } from './components/transacao-form/transacao-form.component';

const routes: Routes = [
  { path: 'transacoes', component: TransacaoListComponent },
  { path: 'transacoes/novo', component: TransacaoFormComponent },
  { path: 'transacoes/editar/:id', component: TransacaoFormComponent },
  { path: '', redirectTo: '/transacoes', pathMatch: 'full' },];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
