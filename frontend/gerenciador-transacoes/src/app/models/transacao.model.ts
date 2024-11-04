export interface Transacao {
    id?: number;
    descricao: string;
    valor: number;
    tipo: 'receita' | 'despesa'; // Define que `tipo` aceita apenas esses dois valores
    categoria: string;
  }
  