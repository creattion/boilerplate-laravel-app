import { format, formatDistanceToNow, parseISO } from 'date-fns';
import { ptBR } from 'date-fns/locale';

type types =
  | 'dateHuman'
  | 'dateHourHuman'
  | 'dateFormatted'
  | 'dateMonth'
  | 'dateHourFormatted'
  | 'hourFormatted'
  | 'hourSecondsFormatted'
  | 'datetimeFormatted'
  | 'en'
  | 'distanceNow';

export default (value?: string, type: types = 'dateFormatted') => {
  if (!value) {
    return '';
  }

  const dateISO = parseISO(value);

  if (type === 'dateHuman') {
    return format(dateISO, "dd 'de' MMMM 'de' Y", {
      locale: ptBR,
    });
  }

  if (type === 'dateHourHuman') {
    return format(dateISO, "dd 'de' MMMM 'de' Y 'às' HH:mm", {
      locale: ptBR,
    });
  }

  if (type === 'dateFormatted') {
    return format(dateISO, 'dd/MM/yyyy', { locale: ptBR });
  }

  if (type === 'dateMonth') {
    return format(dateISO, 'dd/MM', { locale: ptBR });
  }

  if (type === 'dateHourFormatted') {
    return format(dateISO, "dd/MM/yyyy 'às' HH:mm", {
      locale: ptBR,
    });
  }

  if (type === 'hourFormatted') {
    return format(dateISO, 'HH:mm', { locale: ptBR });
  }

  if (type === 'hourSecondsFormatted') {
    return format(dateISO, 'HH:mm:ss', { locale: ptBR });
  }

  if (type === 'datetimeFormatted') {
    return format(dateISO, 'dd/MM/yyyy HH:mm', {
      locale: ptBR,
    });
  }

  if (type === 'en') {
    return format(dateISO, 'yyyy-MM-dd HHH:mm');
  }

  if (type === 'distanceNow') {
    return formatDistanceToNow(dateISO, {
      locale: ptBR,
      addSuffix: true,
    });
  }
};
