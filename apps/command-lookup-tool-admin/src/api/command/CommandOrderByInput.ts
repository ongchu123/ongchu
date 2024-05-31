import { SortOrder } from "../../util/SortOrder";

export type CommandOrderByInput = {
  createdAt?: SortOrder;
  id?: SortOrder;
  updatedAt?: SortOrder;
};
