import { Component, OnInit } from '@angular/core';
import { TransacaoService } from '../../services/transacao.service';
import { Router, ActivatedRoute } from '@angular/router';
import { Transacao } from '../../models/transacao.model';

@Component({
  selector: 'app-transacao-form',
  templateUrl: './transacao-form.component.html',
  styleUrls: ['./transacao-form.component.css']
})
export class TransacaoFormComponent implements OnInit {
  transacao: Transacao = {
    descricao: '',
    valor: 0,
    tipo: 'receita',
    categoria: ''
  };

  isEdit: boolean = false;

  constructor(
    private transacaoService: TransacaoService,
    private router: Router,
    private route: ActivatedRoute
  ) {}

  ngOnInit(): void {
    const id = this.route.snapshot.paramMap.get('id');
    console.log('ID recebido: ', id)
    if (id) {
      this.isEdit = true;
      this.transacaoService.getTransacaoById(+id).subscribe(data => {
        console.log('Dados recebidos: ', data);
        this.transacao = data;
      });
    }
  }
  
  salvarTransacao(): void {
    if (this.isEdit && this.transacao.id) {
      this.transacaoService.updateTransacao(this.transacao.id, this.transacao).subscribe(() => {
        this.router.navigate(['/transacoes']);
      });
    } else {
      this.transacaoService.addTransacao(this.transacao).subscribe(() => {
        this.router.navigate(['/transacoes']);
    });
  }
}
}