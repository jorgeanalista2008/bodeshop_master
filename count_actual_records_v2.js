const fs = require('fs');
const readline = require('readline');

async function countMultiLineInserts() {
  const rl = readline.createInterface({
    input: fs.createReadStream('d:/github/bodeshop_master/u646234231_cristal_gus.sql'),
    crlfDelay: Infinity
  });

  const rowCounts = {};
  let currentTable = null;

  for await (const line of rl) {
    const insertMatch = line.match(/^INSERT INTO [`"']?(\w+)[`"']?/);
    if (insertMatch) {
      currentTable = insertMatch[1];
      if (!rowCounts[currentTable]) rowCounts[currentTable] = 0;
      continue;
    }

    if (currentTable) {
      const trimmed = line.trim();
      if (trimmed.startsWith('(')) {
        rowCounts[currentTable]++;
      }
      if (trimmed.endsWith(';')) {
        currentTable = null;
      }
    }
  }

  const sorted = Object.entries(rowCounts).sort((a,b) => b[1] - a[1]);
  console.log('TABLAS CON REGISTROS REALES EN EL DUMP SQL:');
  console.log('----------------------------------------------------');
  for (const [tbl, count] of sorted) {
    console.log(tbl.padEnd(35) + ': ' + count + ' registros');
  }
}

countMultiLineInserts().catch(console.error);
