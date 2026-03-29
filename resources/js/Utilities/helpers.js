export function usePatch(list, incoming) {
  const id = incoming.id;
  const i = list.value.findIndex((row) => Number(row.id) === Number(id));
  if (i === -1) {
    return;
  }
  const next = { ...list.value[i], ...incoming };
  list.value.splice(i, 1, next);
}

export function useValidationMessage(form, err) {
  const raw = err.response?.data?.errors;
  if (!raw) {
    return;
  }
  const normalized = Object.fromEntries(
    Object.entries(raw).map(([k, v]) => [k, Array.isArray(v) ? v[0] : String(v)])
  );
  form.clearErrors();
  form.setError(normalized);
}
