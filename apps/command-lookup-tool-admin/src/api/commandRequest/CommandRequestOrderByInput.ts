import { SortOrder } from "../../util/SortOrder";

export type CommandRequestOrderByInput = {
  createdAt?: SortOrder;
  id?: SortOrder;
  updatedAt?: SortOrder;
};
