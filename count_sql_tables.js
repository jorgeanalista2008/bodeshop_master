const fs = require('fs');
const readline = require('readline');

async function parseDump() {
  const rl = readline.createInterface({
    input: fs.createReadStream('d:/github/bodeshop_master/u646234231_cristal_gus.sql'),
    crlfDelay: Infinity
  });

  const tables = new Map();
  let currentTable = null;

  for await (const line of rl) {
    const createMatch = line.match(/^CREATE TABLE [`"']?(\w+)[`"']?/);
    if (createMatch) {
      currentTable = createMatch[1];
      if (!tables.has(currentTable)) {
        tables.set(currentTable, { inserts: 0, approxRows: 0 });
      }
    }
    const insertMatch = line.match(/^INSERT INTO [`"']?(\w+)[`"']?/);
    if (insertMatch) {
      const tbl = insertMatch[1];
      if (!tables.has(tbl)) tables.set(tbl, { inserts: 0, approxRows: 0 });
      const entry = tables.get(tbl);
      entry.inserts++;
      const count = (line.match(/\),\(/g) || []).length + 1;
      entry.approxRows += count;
    }
  }

  const sorted = Array.from(tables.entries()).sort((a,b) => b[1].approxRows - a[1].approxRows);
  console.log('Total tables in SQL dump:', sorted.length);
  console.log('----------------------------------------------------------------------');
  console.log(String('Table Name').padEnd(35) + String('Inserts').padStart(10) + String('Est. Rows').padStart(15));
  console.log('----------------------------------------------------------------------');
  for (const [tbl, data] of sorted) {
    console.log(tbl.padEnd(35) + String(data.inserts).padStart(10) + String(data.approxRows).padStart(15));
  }
}

parseDump().catch(console.error);
