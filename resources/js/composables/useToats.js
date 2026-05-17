import { useToast as primeUseToast } from 'primevue/usetoast'

export function useToast() {
   const toast = primeUseToast()

   const success = (message) => {
      toast.add({
         severity: 'success',
         summary: 'Success',
         detail: message,
         life: 3000,
      })
   }

   return {
      success,
   }
}