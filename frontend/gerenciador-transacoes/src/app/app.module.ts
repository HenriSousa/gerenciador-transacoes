import { NgModule } from '@angular/core';
import { BrowserModule, provideClientHydration } from '@angular/platform-browser';
import { FormsModule } from '@angular/forms';
import { HttpClientModule, provideHttpClient, withFetch } from '@angular/common/http'

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { TransacaoListComponent } from './components/transacao-list/transacao-list.component';
import { TransacaoFormComponent } from './components/transacao-form/transacao-form.component';
import { RouterModule } from '@angular/router';
import { TransacaoService } from './services/transacao.service';

@NgModule({
  declarations: [
    AppComponent,
    TransacaoListComponent,
    TransacaoFormComponent
  ],
  imports: [
    BrowserModule,
    FormsModule,
    HttpClientModule,
    AppRoutingModule,
    RouterModule.forRoot([]),
  ],
  providers: [
    provideHttpClient(withFetch()),
    TransacaoService
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
