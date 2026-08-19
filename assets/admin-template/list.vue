<!--
NIUCLOUD Admin 管理端列表页面模板
使用说明：复制此文件到 admin/src/addon/插件标识/views/模块名/list.vue
-->
<template>
    <div>
        <!-- 搜索区域 -->
        <el-card class="box-card !border-none my-[10px] table-search-wrap">
            <el-form :inline="true" :model="tableData.searchParam" ref="searchFormRef">
                <el-form-item :label="t('字段名')" prop="字段名">
                    <el-input v-model="tableData.searchParam.字段名" :placeholder="t('请输入字段名')" />
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="loadList()">{{ t('search') }}</el-button>
                    <el-button @click="resetForm(searchFormRef)">{{ t('reset') }}</el-button>
                </el-form-item>
            </el-form>
        </el-card>

        <!-- 表格区域 -->
        <el-card class="box-card !border-none my-[10px] table-search-wrap">
            <div class="flex justify-between items-center">
                <span class="text-lg font-bold">{{ pageName }}</span>
                <el-button type="primary" @click="addFn">{{ t('add') }}</el-button>
            </div>
            
            <el-table :data="tableData.data" v-loading="tableData.loading" stripe>
                <el-table-column prop="id" :label="t('id')" min-width="80" />
                <el-table-column prop="字段名" :label="t('字段名')" min-width="150" />
                <el-table-column prop="create_time" :label="t('createTime')" min-width="180" />
                <el-table-column :label="t('operation')" fixed="right" min-width="150">
                    <template #default="{ row }">
                        <el-button type="primary" link @click="editFn(row.id)">{{ t('edit') }}</el-button>
                        <el-button type="danger" link @click="deleteFn(row.id)">{{ t('delete') }}</el-button>
                    </template>
                </el-table-column>
            </el-table>
            
            <div class="mt-[10px] flex justify-end">
                <el-pagination 
                    v-model:current-page="tableData.page"
                    v-model:page-size="tableData.limit"
                    layout="total, sizes, prev, pager, next, jumper"
                    :total="tableData.total"
                    @size-change="loadList()"
                    @current-change="loadList()" />
            </div>
        </el-card>
        
        <!-- 添加/编辑弹框 -->
        <el-dialog v-model="dialogVisible" :title="dialogTitle" width="500px">
            <el-form :model="formData" ref="formRef" label-width="100px">
                <el-form-item :label="t('字段名')" prop="字段名">
                    <el-input v-model="formData.字段名" :placeholder="t('请输入字段名')" />
                </el-form-item>
            </el-form>
            <template #footer>
                <span class="dialog-footer">
                    <el-button @click="dialogVisible = false">{{ t('cancel') }}</el-button>
                    <el-button type="primary" @click="submitForm">{{ t('confirm') }}</el-button>
                </span>
            </template>
        </el-dialog>
    </div>
</template>

<script lang="ts" setup>
import { ref, reactive, onMounted } from 'vue'
import { t } from '@/lang'
import { getPage, getInfo, add, edit, del } from '@/api/插件标识/模块名'
import { ElMessage, ElMessageBox } from 'element-plus'

const pageName = ref('管理列表')
const searchFormRef = ref()
const formRef = ref()

// 列表数据
const tableData = reactive({
    page: 1,
    limit: 10,
    total: 0,
    loading: false,
    data: [],
    searchParam: {
        字段名: ''
    }
})

// 弹框控制
const dialogVisible = ref(false)
const dialogTitle = ref('')
const isEdit = ref(false)
const editId = ref(0)

// 表单数据
const formData = reactive({
    id: 0,
    字段名: ''
})

// 加载列表
const loadList = (page: number = 1) => {
    tableData.loading = true
    tableData.page = page
    
    getPage({
        page: tableData.page,
        limit: tableData.limit,
        字段名: tableData.searchParam.字段名
    }).then(res => {
        tableData.data = res.data.data.list
        tableData.total = res.data.data.count
        tableData.loading = false
    }).catch(() => {
        tableData.loading = false
    })
}

// 添加
const addFn = () => {
    dialogTitle.value = t('add')
    isEdit.value = false
    editId.value = 0
    resetFormData()
    dialogVisible.value = true
}

// 编辑
const editFn = (id: number) => {
    dialogTitle.value = t('edit')
    isEdit.value = true
    editId.value = id
    
    getInfo(id).then(res => {
        const info = res.data.data
        formData.id = info.id
        formData.字段名 = info.字段名
        dialogVisible.value = true
    })
}

// 删除
const deleteFn = (id: number) => {
    ElMessageBox.confirm(t('确定删除吗？'), t('warning'), {
        confirmButtonText: t('confirm'),
        cancelButtonText: t('cancel'),
        type: 'warning'
    }).then(() => {
        del(id).then(() => {
            ElMessage.success(t('deleteSuccess'))
            loadList()
        })
    })
}

// 提交表单
const submitForm = () => {
    if (isEdit.value) {
        edit(editId.value, formData).then(() => {
            ElMessage.success(t('editSuccess'))
            dialogVisible.value = false
            loadList()
        })
    } else {
        add(formData).then(() => {
            ElMessage.success(t('addSuccess'))
            dialogVisible.value = false
            loadList()
        })
    }
}

// 重置表单数据
const resetFormData = () => {
    formData.id = 0
    formData.字段名 = ''
}

// 重置搜索表单
const resetForm = (formEl: any) => {
    if (!formEl) return
    formEl.resetFields()
    loadList()
}

onMounted(() => {
    loadList()
})
</script>

<style lang="scss" scoped>
.box-card {
    .el-table {
        margin-top: 15px;
    }
}
</style>
