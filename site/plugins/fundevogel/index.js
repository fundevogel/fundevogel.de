// eslint-disable-next-line no-undef
panel.plugin('fundevogel/methods', {
  blocks: {
    books: {
      template: `
        <div>
            <h3 style="margin-bottom: 0.5rem">Büchergalerie</h3>
            <table>
                <tr v-for="page in content.books">
                    <td style="width: 40%">{{ page.book[0].info }}</td>
                    <td style="width: 60%">{{ page.book[0].text }}</td>
                </tr>
            </table>
        </div>
      `,
    },
    hr: {
      template: `
            <div>
                <div v-if="content.size == 'lg'" style="display: flex; justify-content: center"><hr style="width: 45%"></div>
                <div v-else-if="content.size == 'sm'" style="display: flex; justify-content: center"><hr style="width: 30%"></div>
                <div v-else style="display: flex; justify-content: center"><hr style="width: 15%"></div>
            </div>
            `,
    },
  },
});
