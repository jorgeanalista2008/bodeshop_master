const fs = require('fs');
const readline = require('readline');

async function countActualRecords() {
  const rl = readline.createInterface({
    input: fs.createReadStream('d:/github/bodeshop_master/u646234231_cristal_gus.sql'),
    crlfDelay: Infinity
  });

  const rowCounts = {};

  for await (const line of rl) {
    const insertMatch = line.match(/^INSERT INTO [`"']?(\w+)[`"']?\s*(?:\([^)]+\))?\s*VALUES\s*(.*);?$/);
    if (insertMatch) {
      const tbl = insertMatch[1];
      const valuesPart = insertMatch[2];
      
      // Contar tuplas reales contando los cierres de paréntesis seguidos de coma o fin
      // En un dump de mysqldump/phpmyadmin estándar: (1, 'val', ...), (2, 'val', ...)
      let count = 0;
      let inString = false;
      let escape = false;
      let depth = 0;

      for (let i = 0; i < valuesPart.length; i++) {
        const c = valuesPart[i];
        if (escape) {
          escape = false;
          continue;
        }
        if (c === '\\') {
          escape = true;
          continue;
        }
        if (c === "'" && !escape) {
          inString = !inString;
          continue;
        }
        if (!inString) {
          if (c === '(') {
            if (depth === 0) count++;
            depth++;
          } else if (c === ')') {
            depth--;
          }
        }
      }
      rowCounts[tbl] = (rowCounts[tbl] || 0) + count;
    }
  }

  const sorted = Object.entries(rowCounts).sort((a,b) => b[1] - a[1]);
  console.log('TABLAS CON REGISTROS REALES EN EL DUMP:');
  console.log('----------------------------------------------------');
  for (const [tbl, count] of sorted) {
    console.log(tbl.padEnd(35) + ': ' + count + ' registros');
  }
}

countActualRecords().catch(console.error);
