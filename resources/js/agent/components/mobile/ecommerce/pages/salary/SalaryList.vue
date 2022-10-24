<template>
  <div class="padding-around">
      <div class="card w3-shadow">
          <div class="card-header h5 w3-deep-orange">
              My Salary Satements
          </div>
          <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-striped table-bordered   table-sm" style="white-space: nowrap">
                      <thead>
                          <th>Date</th>
                          <th>Income</th>
                          <th>Paid Amount</th>
                          <th>Remaining Income</th>
                      </thead>
                      <tbody>
                          <tr v-for="salary in salaries" :key="salary.id">
                              <td> {{ salary.trans_date }}</td>
                              <td> &#2547; {{ salary.previous_income }}</td>
                              <td> &#2547; {{ salary.paid_amount }}</td>
                              <td> &#2547; {{ salary.current_income }}</td>
                          </tr>
                      </tbody>
                  </table>
              </div>
              <nav>
            <ul class="pagination table-responsive padding-top" v-if="links.length > 3">
            <li class="page-item" v-for="(page, index) in links" :key="index" :class="{disabled: !page.url, active: page.active}">
            <a class="page-link" v-on:click="getSalaries(page.url)" tabindex="-1">
                <span class="d-flex" v-if="page.label == 'Next &raquo;'">
                    Next <i class="fa fa-arrow-right"></i>
                </span>
                <span class="d-flex" v-else-if="page.label == '&laquo; Previous'">
                    <i class="fa fa-arrow-left"></i> Previous
                </span>
                <span v-else>
                    {{ page.label }}
                </span>
                </a>
            </li>
        </ul>
        </nav>
        </div>
      </div>
  </div>
</template>

<script>
export default {
    props: ['agent'],
    data() {
        return {
            salaries: [],
            links: [],
        }
    },
    created() {
        this.getSalaries()
    },
    methods: {
        getSalaries(dataUrl = null){
    axios.post(dataUrl ? dataUrl : window.location.origin+`/api/agent/${this.agent}/my-salaries`).then(res=>{
                if (res.status == 200) {
                    this.salaries = res.data.data
                    this.links = res.data.links
                }
            });

    }
    },
}
</script>

<style>

</style>
