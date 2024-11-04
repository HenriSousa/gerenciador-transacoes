import { Component, OnInit } from '@angular/core';
import { TransacaoService } from '../../services/transacao.service';
import { Transacao } from '../../models/transacao.model';
import { Router } from '@angular/router';

@Component({
  selector: 'app-transacao-list',
  templateUrl: './transacao-list.component.html',
  styleUrls: ['./transacao-list.component.css']
})
export class TransacaoListComponent implements OnInit {
  transacoes: Transacao[] = [];
  tipoSelecionado: string = '';

  constructor(private transacaoService: TransacaoService, private router: Router) {}

  ngOnInit(): void {
    this.carregarTransacoes();
  }

  carregarTransacoes(tipo?: string): void {
    this.transacaoService.getTransacoes(tipo).subscribe(data => {
      this.transacoes = data;
    });
  }

  editarTransacao(id?: number): void {
    if (id !== undefined) {
      this.router.navigate([`/transacoes/editar/${id}`]);
    } else {
      console.warn('ID da transação não disponível para edição.');
    }
  }

  deletarTransacao(id?: number): void {
    if (id !== undefined) {
      this.transacaoService.deleteTransacao(id).subscribe(() => {
        this.carregarTransacoes(); // Recarrega a lista após a exclusão
      });
    } else {
      console.warn('ID da transação não disponível para exclusão.');
    }
}
}
